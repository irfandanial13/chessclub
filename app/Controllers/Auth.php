<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // TODO: Validate against DB - for now mock check
            if ($email == 'admin@club.com' && $password == '123456') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid login');
            }
        }

        return view('auth/login');
    }
}
