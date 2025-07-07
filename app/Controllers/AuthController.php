<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && (password_verify($password, $user['password']) || $user['password'] === $password)) {
            // If plain text matched, upgrade to hash
            if ($user['password'] === $password) {
                $model->update($user['id'], ['password' => password_hash($password, PASSWORD_DEFAULT)]);
            }
            if ($user['status'] !== 'Active') {
                return redirect()->back()->with('error', 'Account inactive.');
            }

            $session->set([
                'isLoggedIn' => true,
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'membership_level' => $user['membership_level'],
            ]);

            // 🔁 Redirect based on membership level
            if ($user['membership_level'] === 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Wrong email or password.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $model = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'membership_level' => $this->request->getPost('membership_level') ?: 'Bronze',
            'status' => 'Active',
        ];

        $model->save($data);

        return redirect()->to('/login')->with('success', 'Registered successfully!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have logged out.');
    }
}
