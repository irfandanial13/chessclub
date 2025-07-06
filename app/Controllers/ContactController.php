<?php

namespace App\Controllers;

class ContactController extends BaseController
{
    public function index()
    {
        return view('contact/index', [
            'title' => 'Contact Us - Chess Club'
        ]);
    }

    public function sendMessage()
    {
        // Get form data
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        // Basic validation
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            return redirect()->back()->with('error', 'Please fill in all fields.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Please enter a valid email address.');
        }

        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Log the contact request
        
        // For now, we'll just redirect with success message
        return redirect()->to(base_url('contact'))->with('success', 'Thank you for your message! We will get back to you soon.');
    }
} 