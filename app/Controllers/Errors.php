<?php

namespace App\Controllers;

class Errors extends BaseController
{
    public function error404()
    {
        $data = [
            'title' => 'Page Not Found',
            'error_code' => '404',
            'error_message' => 'The page you are looking for could not be found.',
            'suggestions' => [
                'Check the URL for any typos',
                'Go back to the previous page',
                'Visit our homepage',
                'Contact support if you believe this is an error'
            ]
        ];
        
        return view('errors/404', $data);
    }

    public function error403()
    {
        $data = [
            'title' => 'Access Forbidden',
            'error_code' => '403',
            'error_message' => 'You do not have permission to access this resource.',
            'suggestions' => [
                'Make sure you are logged in',
                'Check if you have the required permissions',
                'Contact an administrator if you believe this is an error',
                'Go back to the previous page'
            ]
        ];
        
        return view('errors/403', $data);
    }

    public function error500()
    {
        $data = [
            'title' => 'Server Error',
            'error_code' => '500',
            'error_message' => 'Something went wrong on our end. Please try again later.',
            'suggestions' => [
                'Refresh the page',
                'Try again in a few minutes',
                'Contact support if the problem persists',
                'Go back to the previous page'
            ]
        ];
        
        return view('errors/500', $data);
    }
} 