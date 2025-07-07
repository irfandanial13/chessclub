<?php

namespace App\Libraries;

use CodeIgniter\Validation\Rules;

class CustomValidationRules extends Rules
{
    /**
     * Check if date is in the future
     */
    public function check_future_date(string $str, string &$error = null): bool
    {
        $date = strtotime($str);
        $today = strtotime(date('Y-m-d'));
        
        if ($date <= $today) {
            $error = 'Date must be in the future.';
            return false;
        }
        
        return true;
    }

    /**
     * Check if date is today or in the future
     */
    public function check_today_or_future(string $str, string &$error = null): bool
    {
        $date = strtotime($str);
        $today = strtotime(date('Y-m-d'));
        
        if ($date < $today) {
            $error = 'Date cannot be in the past.';
            return false;
        }
        
        return true;
    }

    /**
     * Validate chess rating format (e.g., 1200, 1500, 2000+)
     */
    public function valid_chess_rating(string $str, string &$error = null): bool
    {
        if (preg_match('/^\d{3,4}(\+)?$/', $str)) {
            $rating = (int) $str;
            if ($rating >= 100 && $rating <= 3000) {
                return true;
            }
        }
        
        $error = 'Chess rating must be between 100-3000.';
        return false;
    }

    /**
     * Validate membership level
     */
    public function valid_membership_level(string $str, string &$error = null): bool
    {
        $validLevels = ['Bronze', 'Silver', 'Gold', 'Admin'];
        
        if (!in_array($str, $validLevels)) {
            $error = 'Invalid membership level.';
            return false;
        }
        
        return true;
    }

    /**
     * Validate phone number format
     */
    public function valid_phone(string $str, string &$error = null): bool
    {
        // Remove all non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $str);
        
        // Check if it's a valid phone number (10-15 digits)
        if (strlen($phone) >= 10 && strlen($phone) <= 15) {
            return true;
        }
        
        $error = 'Please enter a valid phone number.';
        return false;
    }

    /**
     * Validate Malaysian phone number
     */
    public function valid_my_phone(string $str, string &$error = null): bool
    {
        // Remove all non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $str);
        
        // Malaysian phone number patterns
        $patterns = [
            '/^1[0-9]{8,9}$/',  // Mobile: 01xxxxxxxx
            '/^3[0-9]{7,8}$/',  // Landline: 03xxxxxxx
            '/^4[0-9]{7,8}$/',  // Landline: 04xxxxxxx
            '/^5[0-9]{7,8}$/',  // Landline: 05xxxxxxx
            '/^6[0-9]{7,8}$/',  // Landline: 06xxxxxxx
            '/^7[0-9]{7,8}$/',  // Landline: 07xxxxxxx
            '/^8[0-9]{7,8}$/',  // Landline: 08xxxxxxx
            '/^9[0-9]{7,8}$/',  // Landline: 09xxxxxxx
        ];
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $phone)) {
                return true;
            }
        }
        
        $error = 'Please enter a valid Malaysian phone number.';
        return false;
    }

    /**
     * Validate Malaysian IC number
     */
    public function valid_my_ic(string $str, string &$error = null): bool
    {
        // Remove all non-digit characters
        $ic = preg_replace('/[^0-9]/', '', $str);
        
        // Malaysian IC format: YYMMDD-PB-XXXX
        if (strlen($ic) === 12) {
            $year = substr($ic, 0, 2);
            $month = substr($ic, 2, 2);
            $day = substr($ic, 4, 2);
            
            // Basic date validation
            if ($month >= 1 && $month <= 12 && $day >= 1 && $day <= 31) {
                return true;
            }
        }
        
        $error = 'Please enter a valid Malaysian IC number.';
        return false;
    }

    /**
     * Validate postal code
     */
    public function valid_postal_code(string $str, string &$error = null): bool
    {
        // Remove all non-digit characters
        $postal = preg_replace('/[^0-9]/', '', $str);
        
        // Check if it's 5 digits
        if (strlen($postal) === 5) {
            return true;
        }
        
        $error = 'Please enter a valid 5-digit postal code.';
        return false;
    }

    /**
     * Validate amount with decimal places
     */
    public function valid_amount(string $str, string &$error = null): bool
    {
        if (preg_match('/^\d+(\.\d{1,2})?$/', $str)) {
            $amount = (float) $str;
            if ($amount > 0 && $amount <= 999999.99) {
                return true;
            }
        }
        
        $error = 'Please enter a valid amount (max 999,999.99).';
        return false;
    }

    /**
     * Validate file size in MB
     */
    public function max_size_mb(string $str, string $field, array $data, string &$error = null): bool
    {
        $maxSize = $data[0] ?? 2; // Default 2MB
        $fileSize = $_FILES[$field]['size'] ?? 0;
        
        if ($fileSize > ($maxSize * 1024 * 1024)) {
            $error = "File size cannot exceed {$maxSize}MB.";
            return false;
        }
        
        return true;
    }

    /**
     * Validate image dimensions
     */
    public function image_dimensions(string $str, string $field, array $data, string &$error = null): bool
    {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            return true; // Skip if no file uploaded
        }
        
        $imageInfo = getimagesize($_FILES[$field]['tmp_name']);
        if (!$imageInfo) {
            $error = 'Invalid image file.';
            return false;
        }
        
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $maxWidth = $data[0] ?? 1920;
        $maxHeight = $data[1] ?? 1080;
        
        if ($width > $maxWidth || $height > $maxHeight) {
            $error = "Image dimensions cannot exceed {$maxWidth}x{$maxHeight} pixels.";
            return false;
        }
        
        return true;
    }

    /**
     * Validate strong password
     */
    public function strong_password(string $str, string &$error = null): bool
    {
        $errors = [];
        
        if (strlen($str) < 8) {
            $errors[] = 'at least 8 characters';
        }
        
        if (!preg_match('/[A-Z]/', $str)) {
            $errors[] = 'one uppercase letter';
        }
        
        if (!preg_match('/[a-z]/', $str)) {
            $errors[] = 'one lowercase letter';
        }
        
        if (!preg_match('/[0-9]/', $str)) {
            $errors[] = 'one number';
        }
        
        if (!preg_match('/[@$!%*?&]/', $str)) {
            $errors[] = 'one special character (@$!%*?&)';
        }
        
        if (!empty($errors)) {
            $error = 'Password must contain ' . implode(', ', $errors) . '.';
            return false;
        }
        
        return true;
    }

    /**
     * Validate username format
     */
    public function valid_username(string $str, string &$error = null): bool
    {
        if (preg_match('/^[a-zA-Z0-9_]{3,20}$/', $str)) {
            return true;
        }
        
        $error = 'Username must be 3-20 characters long and contain only letters, numbers, and underscores.';
        return false;
    }

    /**
     * Validate time format (HH:MM)
     */
    public function valid_time(string $str, string &$error = null): bool
    {
        if (preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $str)) {
            return true;
        }
        
        $error = 'Please enter a valid time in HH:MM format.';
        return false;
    }

    /**
     * Validate event capacity
     */
    public function valid_event_capacity(string $str, string &$error = null): bool
    {
        if (is_numeric($str) && $str > 0 && $str <= 1000) {
            return true;
        }
        
        $error = 'Event capacity must be between 1 and 1000.';
        return false;
    }

    /**
     * Validate age (must be 18 or older)
     */
    public function adult_age(string $str, string &$error = null): bool
    {
        $birthDate = new \DateTime($str);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;
        
        if ($age >= 18) {
            return true;
        }
        
        $error = 'You must be at least 18 years old.';
        return false;
    }

    /**
     * Validate age (must be 13 or older)
     */
    public function teen_age(string $str, string &$error = null): bool
    {
        $birthDate = new \DateTime($str);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;
        
        if ($age >= 13) {
            return true;
        }
        
        $error = 'You must be at least 13 years old.';
        return false;
    }
} 