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
}