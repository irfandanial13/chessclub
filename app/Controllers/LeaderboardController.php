<?php

namespace App\Controllers;

use App\Models\UserModel;

class LeaderboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $allUsers = $userModel->where('status', 'Active')
                              ->orderBy('points', 'DESC')
                              ->findAll();

        $currentUser = session()->get('user_id');

        return view('leaderboard/index', [
            'users' => $allUsers,
            'currentUser' => $currentUser
        ]);
    }
}
