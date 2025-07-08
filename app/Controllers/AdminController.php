<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PaymentModel;

class AdminController extends BaseController
{
    private function requireAdmin()
    {
        if (session()->get('membership_level') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'Admin access required.');
        }
    }

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
            return redirect()->to(base_url('admin/users'))->with('error', 'Invalid user ID');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('admin/users'))->with('error', 'User not found');
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
        return redirect()->to(base_url('admin/users'))->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to(base_url('admin/users'))->with('success', 'User deleted successfully');
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
        $validation = \Config\Services::validation();
        
        // Set validation rules
        $validation->setRules([
            'title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Event title is required.',
                    'min_length' => 'Event title must be at least 3 characters long.',
                    'max_length' => 'Event title cannot exceed 255 characters.'
                ]
            ],
            'event_date' => [
                'rules' => 'required|valid_date|check_future_date',
                'errors' => [
                    'required' => 'Event date is required.',
                    'valid_date' => 'Please enter a valid date.',
                    'check_future_date' => 'Event date must be in the future.'
                ]
            ],
            'description' => [
                'rules' => 'required|min_length[10]|max_length[1000]',
                'errors' => [
                    'required' => 'Event description is required.',
                    'min_length' => 'Event description must be at least 10 characters long.',
                    'max_length' => 'Event description cannot exceed 1000 characters.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $eventModel = new \App\Models\EventModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'event_date' => $this->request->getPost('event_date'),
            'description' => $this->request->getPost('description'),
        ];
        
        try {
        $eventModel->insert($data);
        return redirect()->to(base_url('admin/event'))->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create event. Please try again.');
        }
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
        $validation = \Config\Services::validation();
        
        // Set validation rules
        $validation->setRules([
            'title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Event title is required.',
                    'min_length' => 'Event title must be at least 3 characters long.',
                    'max_length' => 'Event title cannot exceed 255 characters.'
                ]
            ],
            'event_date' => [
                'rules' => 'required|valid_date|check_today_or_future',
                'errors' => [
                    'required' => 'Event date is required.',
                    'valid_date' => 'Please enter a valid date.',
                    'check_today_or_future' => 'Event date cannot be in the past.'
                ]
            ],
            'description' => [
                'rules' => 'required|min_length[10]|max_length[1000]',
                'errors' => [
                    'required' => 'Event description is required.',
                    'min_length' => 'Event description must be at least 10 characters long.',
                    'max_length' => 'Event description cannot exceed 1000 characters.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $eventModel = new \App\Models\EventModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'event_date' => $this->request->getPost('event_date'),
            'description' => $this->request->getPost('description'),
        ];
        
        try {
        $eventModel->update($event_id, $data);
        return redirect()->to(base_url('admin/event'))->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update event. Please try again.');
        }
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

    public function bulkUpdatePoints()
    {
        $userModel = new UserModel();
        $points = $this->request->getPost('points');
        $reason = $this->request->getPost('reason') ?? 'Bulk admin adjustment';
        
        if (!is_numeric($points)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid points value']);
        }

        // Get all active users
        $users = $userModel->where('status', 'Active')->findAll();
        
        if (empty($users)) {
            return $this->response->setJSON(['success' => false, 'message' => 'No active users found']);
        }

        $updatedCount = 0;
        $errors = [];

        foreach ($users as $user) {
            try {
                $newPoints = max(0, ($user['honor_points'] ?? 0) + $points);
                $userModel->update($user['id'], ['honor_points' => $newPoints]);
                $updatedCount++;
            } catch (\Exception $e) {
                $errors[] = "Failed to update user {$user['name']}: " . $e->getMessage();
            }
        }

        if ($updatedCount > 0) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "Successfully updated points for {$updatedCount} users",
                'updatedCount' => $updatedCount,
                'adjustment' => $points,
                'errors' => $errors
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update any users',
                'errors' => $errors
            ]);
        }
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

    // Order Management Methods
    public function manageOrders()
    {
        $orderModel = new \App\Models\OrderModel();
        
        // Get search parameters
        $search = $this->request->getGet('search');
        
        // Get orders with details
        $orders = $orderModel->getOrdersWithDetails();
        
        // Filter by search
        if ($search) {
            $orders = array_filter($orders, function($order) use ($search) {
                return stripos((string)$order['id'], $search) !== false ||
                       stripos($order['user_name'] ?? '', $search) !== false ||
                       stripos($order['user_email'] ?? '', $search) !== false;
            });
        }
        
        // Get statistics
        $stats = $orderModel->getOrderStats();
        
        $data = [
            'title' => 'Manage Orders',
            'orders' => $orders,
            'totalOrders' => $stats['total_orders'] ?? 0,
            'totalRevenue' => $stats['total_revenue'] ?? 0,
            'avgOrderValue' => $stats['avg_order_value'] ?? 0,
            'recentOrders' => $stats['recent_orders'] ?? 0,
            'search' => $search
        ];
        
        return view('admin/manage_orders', $data);
    }

    public function deleteOrder($id)
    {
        $orderModel = new \App\Models\OrderModel();
        $orderItemModel = new \App\Models\OrderItemModel();
        
        // Start transaction
        $orderModel->db->transStart();
        
        try {
            // Delete order items first
            $orderItemModel->deleteByOrderId($id);
            
            // Delete order
            if (!$orderModel->delete($id)) {
                throw new \Exception('Failed to delete order');
            }
            
            $orderModel->db->transComplete();
            
            if ($orderModel->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }
            
            return redirect()->to(base_url('admin/orders'))->with('success', 'Order deleted successfully');
            
        } catch (\Exception $e) {
            $orderModel->db->transRollback();
            return redirect()->to(base_url('admin/orders'))->with('error', 'Failed to delete order');
        }
    }

    public function viewOrder($id)
    {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Invalid order ID');
        }

        $orderModel = new \App\Models\OrderModel();
        $order = $orderModel->getOrderWithDetails($id);

        if (!$order) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Order not found');
        }

        return view('admin/view_order', [
            'title' => 'View Order',
            'order' => $order
        ]);
    }

    public function updateOrderStatus($id)
    {
        $orderModel = new \App\Models\OrderModel();
        $status = $this->request->getPost('status');
        
        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        if (!in_array($status, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }
        
        if ($orderModel->update($id, ['status' => $status])) {
            return redirect()->back()->with('success', 'Order status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update order status.');
        }
    }

    // Merchandise Management Methods
    public function manageMerchandise()
    {
        $merchandiseModel = new \App\Models\MerchandiseModel();
        $search = $this->request->getGet('search');
        $availability = $this->request->getGet('availability');

        $query = $merchandiseModel;
        
        if ($search) {
            $query = $query->like('name', $search);
        }
        
        if ($availability && $availability !== 'all') {
            if ($availability === 'available') {
                $query = $query->where('is_available', true);
            } elseif ($availability === 'unavailable') {
                $query = $query->where('is_available', false);
            } elseif ($availability === 'out_of_stock') {
                $query = $query->where('stock_quantity', 0);
            }
        }
        
        $merchandise = $query->findAll();
        $stats = $merchandiseModel->getStats();

        return view('admin/manage_merchandise', [
            'title' => 'Manage Merchandise',
            'merchandise' => $merchandise,
            'stats' => $stats,
            'search' => $search,
            'availability' => $availability
        ]);
    }

    public function createMerchandise()
    {
        return view('admin/create_merchandise', [
            'title' => 'Create Merchandise'
        ]);
    }

    public function storeMerchandise()
    {
        $validation = \Config\Services::validation();
        
        // Set validation rules
        $validation->setRules([
            'name' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Product name is required.',
                    'min_length' => 'Product name must be at least 2 characters long.',
                    'max_length' => 'Product name cannot exceed 255 characters.'
                ]
            ],
            'description' => [
                'rules' => 'required|min_length[10]|max_length[1000]',
                'errors' => [
                    'required' => 'Product description is required.',
                    'min_length' => 'Product description must be at least 10 characters long.',
                    'max_length' => 'Product description cannot exceed 1000 characters.'
                ]
            ],
            'price' => [
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[999999.99]',
                'errors' => [
                    'required' => 'Product price is required.',
                    'numeric' => 'Price must be a valid number.',
                    'greater_than' => 'Price must be greater than 0.',
                    'less_than_equal_to' => 'Price cannot exceed 999,999.99.'
                ]
            ],
            'stock_quantity' => [
                'rules' => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Stock quantity is required.',
                    'integer' => 'Stock quantity must be a whole number.',
                    'greater_than_equal_to' => 'Stock quantity cannot be negative.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $merchandiseModel = new \App\Models\MerchandiseModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $this->request->getPost('image'),
            'is_available' => $this->request->getPost('is_available') ? true : false,
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        try {
        $merchandiseModel->insert($data);
        return redirect()->to(base_url('admin/merchandise'))->with('success', 'Merchandise created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create merchandise. Please try again.');
        }
    }

    public function editMerchandise($id)
    {
        $merchandiseModel = new \App\Models\MerchandiseModel();
        $merchandise = $merchandiseModel->find($id);
        
        if (!$merchandise) {
            return redirect()->to(base_url('admin/merchandise'))->with('error', 'Merchandise not found');
        }

        return view('admin/edit_merchandise', [
            'title' => 'Edit Merchandise',
            'merchandise' => $merchandise
        ]);
    }

    public function updateMerchandise($id)
    {
        $merchandiseModel = new \App\Models\MerchandiseModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $this->request->getPost('image'),
            'is_available' => $this->request->getPost('is_available') ? true : false,
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        $merchandiseModel->update($id, $data);
        return redirect()->to(base_url('admin/merchandise'))->with('success', 'Merchandise updated successfully');
    }

    public function deleteMerchandise($id)
    {
        $merchandiseModel = new \App\Models\MerchandiseModel();
        $merchandiseModel->delete($id);
        return redirect()->to(base_url('admin/merchandise'))->with('success', 'Merchandise deleted successfully');
    }

    public function toggleMerchandiseAvailability($id)
    {
        $merchandiseModel = new \App\Models\MerchandiseModel();
        $success = $merchandiseModel->toggleAvailability($id);
        
        if ($success) {
            return redirect()->to(base_url('admin/merchandise'))->with('success', 'Availability toggled successfully');
        } else {
            return redirect()->to(base_url('admin/merchandise'))->with('error', 'Failed to toggle availability');
        }
    }

    public function updateMerchandiseStock($id)
    {
        $merchandiseModel = new \App\Models\MerchandiseModel();
        $quantity = $this->request->getPost('stock_quantity');
        
        if (!is_numeric($quantity) || $quantity < 0) {
            return redirect()->to(base_url('admin/merchandise'))->with('error', 'Invalid stock quantity');
        }

        $merchandiseModel->updateStock($id, $quantity);
        return redirect()->to(base_url('admin/merchandise'))->with('success', 'Stock updated successfully');
    }

    public function managePayments()
    {
        if ($redirect = $this->requireAdmin()) return $redirect;
        $paymentModel = new PaymentModel();
        $userModel = new UserModel();
        $sort = $this->request->getGet('sort') ?: 'id';
        $direction = strtoupper($this->request->getGet('direction') ?: 'ASC');
        $allowedSorts = ['id', 'user_id', 'level', 'payment_reference', 'status', 'created_at'];
        $allowedDirections = ['ASC', 'DESC'];
        if (!in_array($sort, $allowedSorts)) $sort = 'id';
        if (!in_array($direction, $allowedDirections)) $direction = 'ASC';
        $payments = $paymentModel->orderBy($sort, $direction)->findAll();
        // Attach user name to each payment
        foreach ($payments as &$payment) {
            $user = $userModel->find($payment['user_id']);
            $payment['user_name'] = $user ? $user['name'] : $payment['user_id'];
        }
        return view('admin/payments', [
            'payments' => $payments,
            'sort' => $sort,
            'direction' => $direction
        ]);
    }

    public function approvePayment($id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;
        $paymentModel = new PaymentModel();
        $userModel = new UserModel();
        $payment = $paymentModel->find($id);
        if (!$payment || $payment['status'] !== 'pending') {
            return redirect()->back()->with('error', 'Invalid or already processed payment.');
        }
        // Approve payment
        $paymentModel->update($id, ['status' => 'approved']);
        // Upgrade user membership
        $userModel->update($payment['user_id'], ['membership_level' => $payment['level']]);
        // Notify user (flash message on next login)
        // (Optional: send email here)
        return redirect()->back()->with('success', 'Payment approved and membership upgraded.');
    }

    public function rejectPayment($id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;
        $paymentModel = new PaymentModel();
        $payment = $paymentModel->find($id);
        if (!$payment || $payment['status'] !== 'pending') {
            return redirect()->back()->with('error', 'Invalid or already processed payment.');
        }
        $paymentModel->update($id, ['status' => 'rejected']);
        // (Optional: send email here)
        return redirect()->back()->with('success', 'Payment rejected.');
    }
}