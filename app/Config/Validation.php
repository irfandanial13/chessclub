<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        \App\Libraries\CustomValidationRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    /**
     * User Registration Validation Rules
     */
    public array $userRegistration = [
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
        'confirm_password' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Please confirm your password.',
                'matches' => 'Passwords do not match.'
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
    ];

    /**
     * User Login Validation Rules
     */
    public array $userLogin = [
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
    ];

    /**
     * Event Creation/Update Validation Rules
     */
    public array $eventValidation = [
        'title' => [
            'rules' => 'required|min_length[3]|max_length[255]',
            'errors' => [
                'required' => 'Event title is required.',
                'min_length' => 'Event title must be at least 3 characters long.',
                'max_length' => 'Event title cannot exceed 255 characters.'
            ]
        ],
        'event_date' => [
            'rules' => 'required|valid_date|check_future_date',
            'errors' => [
                'required' => 'Event date is required.',
                'valid_date' => 'Please enter a valid date.',
                'check_future_date' => 'Event date must be in the future.'
            ]
        ],
        'description' => [
            'rules' => 'required|min_length[10]|max_length[1000]',
            'errors' => [
                'required' => 'Event description is required.',
                'min_length' => 'Event description must be at least 10 characters long.',
                'max_length' => 'Event description cannot exceed 1000 characters.'
            ]
        ]
    ];

    /**
     * Merchandise Validation Rules
     */
    public array $merchandiseValidation = [
        'name' => [
            'rules' => 'required|min_length[2]|max_length[255]',
            'errors' => [
                'required' => 'Product name is required.',
                'min_length' => 'Product name must be at least 2 characters long.',
                'max_length' => 'Product name cannot exceed 255 characters.'
            ]
        ],
        'description' => [
            'rules' => 'required|min_length[10]|max_length[1000]',
            'errors' => [
                'required' => 'Product description is required.',
                'min_length' => 'Product description must be at least 10 characters long.',
                'max_length' => 'Product description cannot exceed 1000 characters.'
            ]
        ],
        'price' => [
            'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[999999.99]',
            'errors' => [
                'required' => 'Product price is required.',
                'numeric' => 'Price must be a valid number.',
                'greater_than' => 'Price must be greater than 0.',
                'less_than_equal_to' => 'Price cannot exceed 999,999.99.'
            ]
        ],
        'stock_quantity' => [
            'rules' => 'required|integer|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'Stock quantity is required.',
                'integer' => 'Stock quantity must be a whole number.',
                'greater_than_equal_to' => 'Stock quantity cannot be negative.'
            ]
        ]
    ];

    /**
     * User Profile Update Validation Rules
     */
    public array $userProfileUpdate = [
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
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email address is required.',
                'valid_email' => 'Please enter a valid email address.'
            ]
        ],
        'membership_level' => [
            'rules' => 'required|in_list[Bronze,Silver,Gold,Admin]',
            'errors' => [
                'required' => 'Please select a membership level.',
                'in_list' => 'Please select a valid membership level.'
            ]
        ],
        'status' => [
            'rules' => 'required|in_list[Active,Inactive]',
            'errors' => [
                'required' => 'Please select a status.',
                'in_list' => 'Please select a valid status.'
            ]
        ]
    ];

    /**
     * Password Change Validation Rules
     */
    public array $passwordChange = [
        'current_password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Current password is required.'
            ]
        ],
        'new_password' => [
            'rules' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/]',
            'errors' => [
                'required' => 'New password is required.',
                'min_length' => 'Password must be at least 8 characters long.',
                'max_length' => 'Password cannot exceed 255 characters.',
                'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
            ]
        ],
        'confirm_new_password' => [
            'rules' => 'required|matches[new_password]',
            'errors' => [
                'required' => 'Please confirm your new password.',
                'matches' => 'Passwords do not match.'
            ]
        ]
    ];

    /**
     * Points Update Validation Rules
     */
    public array $pointsUpdate = [
        'points' => [
            'rules' => 'required|integer|greater_than_equal_to[-1000]|less_than_equal_to[1000]',
            'errors' => [
                'required' => 'Points value is required.',
                'integer' => 'Points must be a whole number.',
                'greater_than_equal_to' => 'Points cannot be less than -1000.',
                'less_than_equal_to' => 'Points cannot exceed 1000.'
            ]
        ],
        'reason' => [
            'rules' => 'required|min_length[5]|max_length[255]',
            'errors' => [
                'required' => 'Reason for points adjustment is required.',
                'min_length' => 'Reason must be at least 5 characters long.',
                'max_length' => 'Reason cannot exceed 255 characters.'
            ]
        ]
    ];

    /**
     * Payment Upload Validation Rules
     */
    public array $paymentUpload = [
        'payment_proof' => [
            'rules' => 'uploaded[payment_proof]|max_size[payment_proof,2048]|is_image[payment_proof]|mime_in[payment_proof,image/jpg,image/jpeg,image/png,image/gif]',
            'errors' => [
                'uploaded' => 'Please select a payment proof file.',
                'max_size' => 'Payment proof file size cannot exceed 2MB.',
                'is_image' => 'Payment proof must be an image file.',
                'mime_in' => 'Payment proof must be a valid image format (JPG, JPEG, PNG, GIF).'
            ]
        ],
        'amount' => [
            'rules' => 'required|numeric|greater_than[0]',
            'errors' => [
                'required' => 'Payment amount is required.',
                'numeric' => 'Amount must be a valid number.',
                'greater_than' => 'Amount must be greater than 0.'
            ]
        ],
        'payment_method' => [
            'rules' => 'required|in_list[Bank Transfer,Credit Card,Cash]',
            'errors' => [
                'required' => 'Payment method is required.',
                'in_list' => 'Please select a valid payment method.'
            ]
        ]
    ];

    /**
     * Contact Form Validation Rules
     */
    public array $contactForm = [
        'name' => [
            'rules' => 'required|min_length[2]|max_length[100]|alpha_space',
            'errors' => [
                'required' => 'Your name is required.',
                'min_length' => 'Name must be at least 2 characters long.',
                'max_length' => 'Name cannot exceed 100 characters.',
                'alpha_space' => 'Name can only contain letters and spaces.'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email address is required.',
                'valid_email' => 'Please enter a valid email address.'
            ]
        ],
        'subject' => [
            'rules' => 'required|min_length[5]|max_length[200]',
            'errors' => [
                'required' => 'Subject is required.',
                'min_length' => 'Subject must be at least 5 characters long.',
                'max_length' => 'Subject cannot exceed 200 characters.'
            ]
        ],
        'message' => [
            'rules' => 'required|min_length[10]|max_length[1000]',
            'errors' => [
                'required' => 'Message is required.',
                'min_length' => 'Message must be at least 10 characters long.',
                'max_length' => 'Message cannot exceed 1000 characters.'
            ]
        ]
    ];
}
