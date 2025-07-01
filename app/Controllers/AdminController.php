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
        return redirect()->to(base_url('admin/event'))->with('success', 'Event deleted successfully');
    }
}