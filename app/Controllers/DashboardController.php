<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Check if logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);
        $data = [
            'title' => 'Member Dashboard',
            'name' => $user['name'],
            'level' => $user['membership_level'],
            'points' => $user['honor_points'] ?? 0, // Honor points from honor_points column
            'redeemable_points' => $user['points'] ?? 0, // Redeemable points from points column
            'events_joined' => 3, // you can fetch real stats if needed
            'classes_booked' => 2, // you can fetch real stats if needed
        ];

        return view('member/dashboard', $data);
    }
}
