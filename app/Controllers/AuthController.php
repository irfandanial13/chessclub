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
        $validation = \Config\Services::validation();
        
        // Set validation rules
        $validation->setRules([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email address is required.',
                    'valid_email' => 'Please enter a valid email address.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password is required.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

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
        $validation = \Config\Services::validation();
        
        // Set validation rules
        $validation->setRules([
            'name' => [
                'rules' => 'required|min_length[2]|max_length[100]|alpha_space',
                'errors' => [
                    'required' => 'Full name is required.',
                    'min_length' => 'Name must be at least 2 characters long.',
                    'max_length' => 'Name cannot exceed 100 characters.',
                    'alpha_space' => 'Name can only contain letters and spaces.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email address is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'is_unique' => 'This email address is already registered.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.',
                    'max_length' => 'Password cannot exceed 255 characters.',
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
                ]
            ],
            'membership_level' => [
                'rules' => 'required|in_list[Bronze,Silver,Gold]',
                'errors' => [
                    'required' => 'Please select a membership level.',
                    'in_list' => 'Please select a valid membership level.'
                ]
            ],
            'terms' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must agree to the terms and conditions.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $model = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'membership_level' => $this->request->getPost('membership_level') ?: 'Bronze',
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        try {
            $model->save($data);
            return redirect()->to('/login')->with('success', 'Registered successfully! Please login.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have logged out.');
    }
}
