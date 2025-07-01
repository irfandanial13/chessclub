<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Optional: Protect route
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        return view('dashboard');
    }
}
