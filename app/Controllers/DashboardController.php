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

        // Example dummy data – you can fetch real stats later
        $data = [
            'title' => 'Member Dashboard',
            'name' => session()->get('user_name'),
            'level' => session()->get('membership_level'),
            'points' => 120, // example
            'events_joined' => 3,
            'classes_booked' => 2,
        ];

        return view('member/dashboard', $data);
    }
}
