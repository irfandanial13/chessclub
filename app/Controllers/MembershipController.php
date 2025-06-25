<?php

namespace App\Controllers;

use App\Models\UserModel;

class MembershipController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        $model = new UserModel();
        $user = $model->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        return view('membership/index', [
            'level' => $user['membership_level'],
            'status' => $user['status'],
            'expiry_date' => '2025-12-31', // Placeholder
        ]);
    }

    public function upgrade()
    {
        $model = new UserModel();
        $userId = session()->get('user_id');

        $newLevel = $this->request->getPost('level');
        $model->update($userId, ['membership_level' => $newLevel]);

        return redirect()->to('/membership')->with('success', 'Membership upgraded!');
    }
}
