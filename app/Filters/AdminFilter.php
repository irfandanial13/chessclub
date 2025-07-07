<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('login')->with('error', 'Please login to access this page.');
        }
        
        // Check if user is admin
        if (session()->get('user_role') !== 'admin') {
            return redirect()->to('dashboard')->with('error', 'Access denied. Admin privileges required.');
        }
        
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
} 