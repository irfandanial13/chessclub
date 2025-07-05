<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard', ['title' => 'Admin Dashboard']);
    }

    public function manageUsers()
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Manage Users',
            'users' => $userModel->findAll()
        ];
        return view('admin/manage_users', $data);
    }

    public function editUser($id = null)
    {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('admin/manage-users'))->with('error', 'Invalid user ID');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('admin/manage-users'))->with('error', 'User not found');
        }

        return view('admin/edit_user', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }

    public function updateUser($id)
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'membership_level' => $this->request->getPost('membership_level'),
            'status' => $this->request->getPost('status'),
        ];

        $userModel->update($id, $data);
        return redirect()->to(base_url('admin/manage-users'))->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to(base_url('admin/manage-users'))->with('success', 'User deleted successfully');
    }

    public function createUser()
    {
        return view('admin/create_user', [
            'title' => 'Create User'
        ]);
    }

    public function storeUser()
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'membership_level' => $this->request->getPost('membership_level'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $userModel->insert($data);
        return redirect()->to(base_url('admin/users'))->with('success', 'User created successfully');
    }

    public function manageEvents()
    {
        $eventModel = new \App\Models\EventModel();
        $data = [
            'title' => 'Manage Events',
            'events' => $eventModel->findAll()
        ];
        return view('admin/manage_events', $data);
    }

    public function createEvent()
    {
        return view('admin/create_event', [
            'title' => 'Create Event'
        ]);
    }

    public function storeEvent()
    {
        $eventModel = new \App\Models\EventModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
        ];
        $eventModel->insert($data);
        return redirect()->to(base_url('admin/event'))->with('success', 'Event created successfully');
    }

    public function editEvent($event_id = null)
    {
        if (!$event_id || !is_numeric($event_id)) {
            return redirect()->to(base_url('admin/event'))->with('error', 'Invalid event ID');
        }
        $eventModel = new \App\Models\EventModel();
        $event = $eventModel->find($event_id);
        if (!$event) {
            return redirect()->to(base_url('admin/event'))->with('error', 'Event not found');
        }
        return view('admin/edit_event', [
            'title' => 'Edit Event',
            'event' => $event
        ]);
    }

    public function updateEvent($event_id)
    {
        $eventModel = new \App\Models\EventModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
        ];
        $eventModel->update($event_id, $data);
        return redirect()->to(base_url('admin/event'))->with('success', 'Event updated successfully');
    }

    public function deleteEvent($event_id)
    {
        $eventModel = new \App\Models\EventModel();
        $eventModel->delete($event_id);
        return redirect()->to(base_url('admin/event'))->with('success', 'Event updated successfully');
    }

    // Leaderboard Management Methods
    public function manageLeaderboard()
    {
        $userModel = new UserModel();
        $membershipLevel = $this->request->getGet('membership_level');
        $search = $this->request->getGet('search');
        $sortBy = $this->request->getGet('sort_by') ?? 'honor_points';
        $sortOrder = $this->request->getGet('sort_order') ?? 'DESC';

        $query = $userModel->where('status', 'Active');
        
        if ($membershipLevel && $membershipLevel !== 'All') {
            $query = $query->where('membership_level', $membershipLevel);
        }
        
        if ($search) {
            $query = $query->like('name', $search);
        }
        
        $users = $query->orderBy($sortBy, $sortOrder)->findAll();

        // Calculate ranks
        $rank = 1;
        foreach ($users as &$user) {
            $user['rank'] = $rank++;
        }

        $data = [
            'title' => 'Manage Leaderboard',
            'users' => $users,
            'totalUsers' => count($users),
            'membershipLevels' => ['All', 'Gold', 'Silver', 'Bronze']
        ];
        
        return view('admin/manage_leaderboard', $data);
    }

    public function updateUserPoints($userId)
    {
        $userModel = new UserModel();
        $points = $this->request->getPost('points');
        $reason = $this->request->getPost('reason') ?? 'Admin adjustment';
        
        if (!is_numeric($points)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid points value']);
        }

        $user = $userModel->find($userId);
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }

        $newPoints = max(0, $user['honor_points'] + $points);
        $userModel->update($userId, ['honor_points' => $newPoints]);

        // Log the point adjustment (you can create a separate table for this)
        // $this->logPointAdjustment($userId, $points, $reason, session()->get('user_id'));

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Points updated successfully',
            'newPoints' => $newPoints,
            'adjustment' => $points
        ]);
    }

    public function resetLeaderboard()
    {
        $userModel = new UserModel();
        $userModel->set('honor_points', 0)->update();
        
        return redirect()->to(base_url('admin/leaderboard'))->with('success', 'Leaderboard has been reset');
    }

    public function exportLeaderboard()
    {
        $userModel = new UserModel();
        $users = $userModel->where('status', 'Active')
                          ->orderBy('honor_points', 'DESC')
                          ->findAll();

        $filename = 'leaderboard_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $this->response->setHeader('Content-Type', 'text/csv');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Rank', 'Name', 'Email', 'Membership Level', 'Honor Points', 'Status']);
        
        $rank = 1;
        foreach ($users as $user) {
            fputcsv($output, [
                $rank++,
                $user['name'],
                $user['email'],
                $user['membership_level'],
                $user['honor_points'] ?? 0,
                $user['status']
            ]);
        }
        
        fclose($output);
        return $this->response;
    }

    public function leaderboardAnalytics()
    {
        $userModel = new UserModel();
        
        // Get statistics
        $totalUsers = $userModel->where('status', 'Active')->countAllResults();
        $totalPoints = $userModel->selectSum('honor_points')->where('status', 'Active')->first()['honor_points'] ?? 0;
        $avgPoints = $totalUsers > 0 ? round($totalPoints / $totalUsers, 2) : 0;
        
        // Top 10 users
        $topUsers = $userModel->where('status', 'Active')
                             ->orderBy('honor_points', 'DESC')
                             ->findAll(10);
        
        // Points distribution by membership level
        $goldUsers = $userModel->where('status', 'Active')->where('membership_level', 'Gold')->countAllResults();
        $silverUsers = $userModel->where('status', 'Active')->where('membership_level', 'Silver')->countAllResults();
        $bronzeUsers = $userModel->where('status', 'Active')->where('membership_level', 'Bronze')->countAllResults();
        
        $data = [
            'title' => 'Leaderboard Analytics',
            'totalUsers' => $totalUsers,
            'totalPoints' => $totalPoints,
            'avgPoints' => $avgPoints,
            'topUsers' => $topUsers,
            'goldUsers' => $goldUsers,
            'silverUsers' => $silverUsers,
            'bronzeUsers' => $bronzeUsers
        ];
        
        return view('admin/leaderboard_analytics', $data);
    }
}