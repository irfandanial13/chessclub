<?php

if (!function_exists('display_validation_errors')) {
    /**
     * Display validation errors in a formatted way
     */
    function display_validation_errors($errors = null)
    {
        if (!$errors) {
            $errors = session()->getFlashdata('errors');
        }
        
        if (!$errors) {
            return '';
        }
        
        $html = '<div class="validation-summary">';
        $html .= '<h4><i class="fas fa-exclamation-triangle"></i> Please correct the following errors:</h4>';
        $html .= '<ul>';
        
        foreach ($errors as $error) {
            $html .= '<li>' . esc($error) . '</li>';
        }
        
        $html .= '</ul>';
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('display_field_error')) {
    /**
     * Display field-specific validation error
     */
    function display_field_error($field, $errors = null)
    {
        if (!$errors) {
            $errors = session()->getFlashdata('errors');
        }
        
        if (!$errors || !isset($errors[$field])) {
            return '';
        }
        
        return '<span class="validation-error">' . esc($errors[$field]) . '</span>';
    }
}

if (!function_exists('display_success_message')) {
    /**
     * Display success message
     */
    function display_success_message($message = null)
    {
        if (!$message) {
            $message = session()->getFlashdata('success');
        }
        
        if (!$message) {
            return '';
        }
        
        return '<div class="elite-success"><i class="fas fa-check-circle"></i><span>' . esc($message) . '</span></div>';
    }
}

if (!function_exists('display_error_message')) {
    /**
     * Display error message
     */
    function display_error_message($message = null)
    {
        if (!$message) {
            $message = session()->getFlashdata('error');
        }
        
        if (!$message) {
            return '';
        }
        
        return '<div class="elite-error"><i class="fas fa-exclamation-triangle"></i><span>' . esc($message) . '</span></div>';
    }
}

if (!function_exists('get_field_class')) {
    /**
     * Get CSS class for form field based on validation state
     */
    function get_field_class($field, $errors = null, $additional_class = '')
    {
        if (!$errors) {
            $errors = session()->getFlashdata('errors');
        }
        
        $class = $additional_class;
        
        if ($errors && isset($errors[$field])) {
            $class .= ' error';
        } elseif (old($field)) {
            $class .= ' success';
        }
        
        return trim($class);
    }
}

if (!function_exists('get_field_value')) {
    /**
     * Get field value with old input fallback
     */
    function get_field_value($field, $default = '')
    {
        return old($field, $default);
    }
}

if (!function_exists('is_field_required')) {
    /**
     * Check if field is required based on validation rules
     */
    function is_field_required($field, $validation_rules = [])
    {
        // This is a simple check - you might want to parse actual validation rules
        $required_fields = [
            'name', 'email', 'password', 'confirm_password', 'membership_level',
            'title', 'event_date', 'description', 'price', 'stock_quantity'
        ];
        
        return in_array($field, $required_fields);
    }
}

if (!function_exists('get_validation_rules')) {
    /**
     * Get validation rules for a specific form
     */
    function get_validation_rules($form_type)
    {
        $validation = \Config\Services::validation();
        
        switch ($form_type) {
            case 'user_registration':
                return $validation->userRegistration;
            case 'user_login':
                return $validation->userLogin;
            case 'event':
                return $validation->eventValidation;
            case 'merchandise':
                return $validation->merchandiseValidation;
            case 'user_profile':
                return $validation->userProfileUpdate;
            case 'password_change':
                return $validation->passwordChange;
            case 'points_update':
                return $validation->pointsUpdate;
            case 'payment_upload':
                return $validation->paymentUpload;
            case 'contact_form':
                return $validation->contactForm;
            default:
                return [];
        }
    }
}

if (!function_exists('validate_form_data')) {
    /**
     * Validate form data using specified rules
     */
    function validate_form_data($data, $rules)
    {
        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        
        return $validation->run($data);
    }
}

if (!function_exists('get_validation_errors')) {
    /**
     * Get validation errors
     */
    function get_validation_errors()
    {
        $validation = \Config\Services::validation();
        return $validation->getErrors();
    }
}

if (!function_exists('format_validation_message')) {
    /**
     * Format validation message with field name
     */
    function format_validation_message($message, $field_name = '')
    {
        if ($field_name) {
            $field_name = ucfirst(str_replace('_', ' ', $field_name));
            return str_replace('{field}', $field_name, $message);
        }
        
        return $message;
    }
}

if (!function_exists('get_field_help_text')) {
    /**
     * Get help text for form fields
     */
    function get_field_help_text($field)
    {
        $help_texts = [
            'password' => 'Password must be at least 8 characters long and contain uppercase, lowercase, number, and special character.',
            'email' => 'Enter a valid email address.',
            'phone' => 'Enter a valid phone number (e.g., 012-345-6789).',
            'postal_code' => 'Enter a 5-digit postal code.',
            'price' => 'Enter a valid price (e.g., 99.99).',
            'stock_quantity' => 'Enter a whole number (0 or greater).',
            'event_date' => 'Select a future date for the event.',
            'description' => 'Provide a detailed description (10-1000 characters).'
        ];
        
        return $help_texts[$field] ?? '';
    }
}

if (!function_exists('display_field_help')) {
    /**
     * Display help text for form field
     */
    function display_field_help($field)
    {
        $help_text = get_field_help_text($field);
        
        if (!$help_text) {
            return '';
        }
        
        return '<div class="help-text">' . esc($help_text) . '</div>';
    }
}

if (!function_exists('get_character_count')) {
    /**
     * Get character count for text fields
     */
    function get_character_count($field, $max_length = 1000)
    {
        $value = old($field, '');
        $current_length = strlen($value);
        $remaining = $max_length - $current_length;
        
        $class = 'char-counter';
        if ($remaining <= 0) {
            $class .= ' at-limit';
        } elseif ($remaining <= 50) {
            $class .= ' near-limit';
        }
        
        return '<div class="' . $class . '">' . $current_length . ' / ' . $max_length . ' characters</div>';
    }
}

if (!function_exists('validate_file_upload')) {
    /**
     * Validate file upload
     */
    function validate_file_upload($file, $allowed_types = ['jpg', 'jpeg', 'png', 'gif'], $max_size = 2048)
    {
        $errors = [];
        
        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            $errors[] = 'Please select a valid file.';
            return $errors;
        }
        
        // Check file size (in KB)
        if ($file->getSize() > ($max_size * 1024)) {
            $errors[] = 'File size cannot exceed ' . $max_size . 'KB.';
        }
        
        // Check file type
        $extension = strtolower($file->getExtension());
        if (!in_array($extension, $allowed_types)) {
            $errors[] = 'File type not allowed. Please upload: ' . implode(', ', $allowed_types);
        }
        
        return $errors;
    }
}

if (!function_exists('sanitize_input')) {
    /**
     * Sanitize input data
     */
    function sanitize_input($data, $type = 'string')
    {
        switch ($type) {
            case 'email':
                return filter_var(trim($data), FILTER_SANITIZE_EMAIL);
            case 'url':
                return filter_var(trim($data), FILTER_SANITIZE_URL);
            case 'int':
                return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
            case 'float':
                return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            case 'string':
            default:
                return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
        }
    }
}

if (!function_exists('validate_chess_rating')) {
    /**
     * Validate chess rating format
     */
    function validate_chess_rating($rating)
    {
        if (preg_match('/^\d{3,4}(\+)?$/', $rating)) {
            $rating_num = (int) $rating;
            return $rating_num >= 100 && $rating_num <= 3000;
        }
        return false;
    }
}

if (!function_exists('validate_membership_level')) {
    /**
     * Validate membership level
     */
    function validate_membership_level($level)
    {
        $valid_levels = ['Bronze', 'Silver', 'Gold', 'Admin'];
        return in_array($level, $valid_levels);
    }
} 