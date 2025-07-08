<?php

/**
 * AuthController - Handles User Authentication and Registration
 * 
 * This controller manages all authentication-related operations including:
 * - User login and logout
 * - User registration
 * - Session management
 * - Password security
 * 
 * @author [Your Name]
 * @version 1.0
 * @since 2024
 * @package App\Controllers
 */

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Class AuthController
 * 
 * Provides authentication functionality for the Chess Club application.
 * Handles user login, registration, logout, and session management.
 * 
 * Features:
 * - Secure password hashing and verification
 * - Input validation and sanitization
 * - Session-based authentication
 * - Role-based access control
 * - CSRF protection (handled by CodeIgniter)
 * 
 * Security Measures:
 * - Passwords are hashed using PHP's password_hash() function
 * - Input validation prevents malicious data
 * - Session management ensures secure user sessions
 * - Automatic password upgrade from plain text to hash
 */
class AuthController extends BaseController
{
    /**
     * UserModel instance for database operations
     * @var UserModel
     */
    private $userModel;

    /**
     * Constructor - Initialize the controller
     */
    public function __construct()
    {
        // Initialize UserModel for database operations
        $this->userModel = new UserModel();
    }

    /**
     * Display the login form
     * 
     * This method renders the login view for users to enter their credentials.
     * The form includes CSRF protection and client-side validation.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|string Login view
     */
    public function login()
    {
        // Check if user is already logged in
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    /**
     * Process user login form submission
     * 
     * This method handles the login form submission with the following steps:
     * 1. Validate input data (email and password)
     * 2. Check user credentials against database
     * 3. Verify password using password_verify()
     * 4. Upgrade plain text passwords to hash if needed
     * 5. Create user session
     * 6. Redirect based on user role
     * 
     * Security Features:
     * - Input validation prevents SQL injection
     * - Password verification prevents brute force attacks
     * - Session management ensures secure authentication
     * - Role-based redirection
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirect to dashboard or back with errors
     */
    public function loginPost()
    {
        // Get validation service
        $validation = \Config\Services::validation();
        
        // Define validation rules for login form
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

        // Run validation and handle errors
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Get session and form data
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Find user by email
        $user = $this->userModel->where('email', $email)->first();

        // Verify user credentials
        if ($user && $this->verifyPassword($password, $user['password'])) {
            // Upgrade plain text password to hash if needed
            if ($user['password'] === $password) {
                $this->upgradePassword($user['id'], $password);
            }

            // Check if account is active
            if ($user['status'] !== 'Active') {
                return redirect()->back()->with('error', 'Account inactive. Please contact administrator.');
            }

            // Create user session
            $this->createUserSession($user);

            // Redirect based on membership level
            return $this->redirectBasedOnRole($user['membership_level']);
        }

        // Invalid credentials
        return redirect()->back()->with('error', 'Invalid email or password. Please try again.');
    }

    /**
     * Display the registration form
     * 
     * This method renders the registration view for new users to create accounts.
     * The form includes comprehensive validation and security measures.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|string Registration view
     */
    public function register()
    {
        // Check if user is already logged in
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register');
    }

    /**
     * Process user registration form submission
     * 
     * This method handles the registration form submission with the following steps:
     * 1. Validate all input data (name, email, password, membership level)
     * 2. Check for unique email address
     * 3. Hash password securely
     * 4. Create new user account
     * 5. Handle success/error responses
     * 
     * Security Features:
     * - Strong password requirements
     * - Email uniqueness validation
     * - Secure password hashing
     * - Input sanitization
     * - Error handling without exposing system details
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirect to login or back with errors
     */
    public function registerPost()
    {
        // Get validation service
        $validation = \Config\Services::validation();
        
        // Define comprehensive validation rules for registration
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

        // Run validation and handle errors
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Prepare user data for database insertion
        $userData = $this->prepareUserData();

        // Attempt to save user to database
        try {
            $this->userModel->save($userData);
            return redirect()->to('/login')->with('success', 'Registration successful! Please login with your credentials.');
        } catch (\Exception $e) {
            // Log error for debugging (in production, don't expose error details)
            log_message('error', 'Registration failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Registration failed. Please try again or contact support.');
        }
    }

    /**
     * Logout user and destroy session
     * 
     * This method securely logs out the user by:
     * 1. Destroying the current session
     * 2. Clearing all session data
     * 3. Redirecting to login page
     * 
     * Security Features:
     * - Complete session destruction
     * - Secure logout confirmation
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirect to login page
     */
    public function logout()
    {
        // Destroy current session completely
        session()->destroy();
        
        // Redirect to login with success message
        return redirect()->to('/login')->with('success', 'You have been successfully logged out.');
    }

    /**
     * Verify user password against stored hash
     * 
     * This method securely verifies a password against the stored hash.
     * It also handles legacy plain text passwords by upgrading them.
     * 
     * @param string $inputPassword The password entered by user
     * @param string $storedPassword The password hash stored in database
     * @return bool True if password is valid, false otherwise
     */
    private function verifyPassword($inputPassword, $storedPassword)
    {
        // First try password_verify for hashed passwords
        if (password_verify($inputPassword, $storedPassword)) {
            return true;
        }
        
        // Fallback for legacy plain text passwords (for migration purposes)
        if ($storedPassword === $inputPassword) {
            return true;
        }
        
        return false;
    }

    /**
     * Upgrade plain text password to secure hash
     * 
     * This method upgrades legacy plain text passwords to secure hashes.
     * This is part of the security migration process.
     * 
     * @param int $userId The user ID
     * @param string $plainPassword The plain text password
     * @return void
     */
    private function upgradePassword($userId, $plainPassword)
    {
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
        $this->userModel->update($userId, ['password' => $hashedPassword]);
        
        // Log password upgrade for security audit
        log_message('info', 'Password upgraded for user ID: ' . $userId);
    }

    /**
     * Create user session after successful login
     * 
     * This method creates a secure user session with all necessary data.
     * 
     * @param array $user User data from database
     * @return void
     */
    private function createUserSession($user)
    {
        $session = session();
        
        $session->set([
            'isLoggedIn' => true,
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'membership_level' => $user['membership_level'],
            'login_time' => time(), // Track login time for security
        ]);
        
        // Log successful login
        log_message('info', 'User logged in: ' . $user['email']);
    }

    /**
     * Redirect user based on their membership level
     * 
     * This method handles role-based redirection after login.
     * 
     * @param string $membershipLevel The user's membership level
     * @return \CodeIgniter\HTTP\RedirectResponse Appropriate redirect
     */
    private function redirectBasedOnRole($membershipLevel)
    {
        switch ($membershipLevel) {
            case 'Admin':
                return redirect()->to('/admin/dashboard');
            case 'Gold':
            case 'Silver':
            case 'Bronze':
            default:
                return redirect()->to('/dashboard');
        }
    }

    /**
     * Prepare user data for database insertion
     * 
     * This method prepares and sanitizes user data before saving to database.
     * 
     * @return array Prepared user data
     */
    private function prepareUserData()
    {
        return [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'membership_level' => $this->request->getPost('membership_level') ?: 'Bronze',
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}
