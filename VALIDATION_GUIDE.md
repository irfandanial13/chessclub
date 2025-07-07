# Chess Club Validation System Guide

## Overview

This document provides a comprehensive guide to the validation system implemented in the Chess Club project. The system includes both server-side and client-side validation to ensure data integrity and provide a better user experience.

## Features

### ✅ Server-Side Validation
- **CodeIgniter 4 Validation Rules**: Comprehensive validation rules for all forms
- **Custom Validation Methods**: Chess club specific validation rules
- **Error Handling**: Proper error messages and user feedback
- **Data Sanitization**: Input cleaning and security measures

### ✅ Client-Side Validation
- **jQuery Validation Plugin**: Real-time form validation
- **Custom Validation Methods**: Enhanced validation for chess club needs
- **Visual Feedback**: Immediate user feedback with styling
- **Password Strength Indicator**: Real-time password strength checking

### ✅ Custom Validation Rules
- **Future Date Validation**: Ensures events are scheduled in the future
- **Chess Rating Validation**: Validates chess rating formats (100-3000)
- **Malaysian Phone/IC Validation**: Local format validation
- **Strong Password Requirements**: Enhanced password security
- **File Upload Validation**: Image upload restrictions

## File Structure

```
app/
├── Config/
│   └── Validation.php              # Main validation configuration
├── Libraries/
│   └── CustomValidationRules.php   # Custom validation methods
├── Helpers/
│   └── validation_helper.php       # Validation helper functions
├── Controllers/
│   ├── AuthController.php          # Updated with validation
│   └── AdminController.php         # Updated with validation
└── Views/
    └── auth/
        ├── login.php               # Updated with validation
        └── register.php            # Updated with validation

public/
├── css/
│   └── validation.css              # Validation styling
└── js/
    └── validation.js               # Client-side validation
```

## Server-Side Validation

### Configuration (`app/Config/Validation.php`)

The validation configuration includes predefined rule sets for different forms:

```php
// User Registration
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
    // ... more fields
];
```

### Custom Validation Rules (`app/Libraries/CustomValidationRules.php`)

Custom validation methods specific to the chess club:

```php
// Check if date is in the future
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

// Validate chess rating format
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
```

### Controller Implementation

Example of validation in controllers:

```php
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
        // ... more fields
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $validation->getErrors());
    }

    // Process valid data
    // ...
}
```

## Client-Side Validation

### JavaScript Validation (`public/js/validation.js`)

Real-time form validation using jQuery Validation plugin:

```javascript
// Registration Form Validation
$("#registerForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 2,
            maxlength: 100,
            pattern: /^[a-zA-Z\s]+$/
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 255,
            strongPassword: true
        },
        // ... more fields
    },
    messages: {
        name: {
            required: "Full name is required.",
            minlength: "Name must be at least 2 characters long.",
            maxlength: "Name cannot exceed 100 characters.",
            pattern: "Name can only contain letters and spaces."
        },
        // ... more messages
    }
});
```

### Custom Validation Methods

```javascript
// Strong password validation
$.validator.addMethod("strongPassword", function(value, element) {
    return this.optional(element) || 
           /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/.test(value);
}, "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.");

// Future date validation
$.validator.addMethod("futureDate", function(value, element) {
    if (this.optional(element)) {
        return true;
    }
    var today = new Date();
    var inputDate = new Date(value);
    return inputDate > today;
}, "Date must be in the future.");
```

## Validation Helper Functions

### Helper Functions (`app/Helpers/validation_helper.php`)

Utility functions for displaying validation errors and messages:

```php
// Display validation errors
echo display_validation_errors();

// Display field-specific error
echo display_field_error('email');

// Display success message
echo display_success_message();

// Get field class based on validation state
$class = get_field_class('email', $errors, 'form-control');

// Get field value with old input fallback
$value = get_field_value('email', '');
```

## Form Validation Types

### 1. User Registration
- **Name**: Required, 2-100 characters, letters and spaces only
- **Email**: Required, valid email format, unique in database
- **Password**: Required, 8+ characters, strong password requirements
- **Confirm Password**: Required, must match password
- **Membership Level**: Required, valid selection
- **Terms**: Required checkbox

### 2. User Login
- **Email**: Required, valid email format
- **Password**: Required

### 3. Event Management
- **Title**: Required, 3-255 characters
- **Event Date**: Required, valid date, must be in future
- **Description**: Required, 10-1000 characters

### 4. Merchandise Management
- **Name**: Required, 2-255 characters
- **Description**: Required, 10-1000 characters
- **Price**: Required, numeric, greater than 0, max 999,999.99
- **Stock Quantity**: Required, integer, 0 or greater

### 5. User Profile Updates
- **Name**: Required, 2-100 characters, letters and spaces only
- **Email**: Required, valid email format
- **Membership Level**: Required, valid selection
- **Status**: Required, valid selection

### 6. Password Changes
- **Current Password**: Required
- **New Password**: Required, 8+ characters, strong password requirements
- **Confirm New Password**: Required, must match new password

### 7. Points Updates
- **Points**: Required, integer, -1000 to 1000
- **Reason**: Required, 5-255 characters

### 8. Payment Uploads
- **Payment Proof**: Required, image file (JPG, JPEG, PNG, GIF), max 2MB
- **Amount**: Required, numeric, greater than 0
- **Payment Method**: Required, valid selection

### 9. Contact Forms
- **Name**: Required, 2-100 characters, letters and spaces only
- **Email**: Required, valid email format
- **Subject**: Required, 5-200 characters
- **Message**: Required, 10-1000 characters

## Custom Validation Rules

### Available Custom Rules

1. **`check_future_date`**: Ensures date is in the future
2. **`check_today_or_future`**: Ensures date is today or in the future
3. **`valid_chess_rating`**: Validates chess rating (100-3000)
4. **`valid_membership_level`**: Validates membership level selection
5. **`valid_phone`**: Validates phone number format
6. **`valid_my_phone`**: Validates Malaysian phone number
7. **`valid_my_ic`**: Validates Malaysian IC number
8. **`valid_postal_code`**: Validates 5-digit postal code
9. **`valid_amount`**: Validates monetary amounts
10. **`max_size_mb`**: Validates file size in MB
11. **`image_dimensions`**: Validates image dimensions
12. **`strong_password`**: Validates strong password requirements
13. **`valid_username`**: Validates username format
14. **`valid_time`**: Validates time format (HH:MM)
15. **`valid_event_capacity`**: Validates event capacity (1-1000)
16. **`adult_age`**: Validates age 18 or older
17. **`teen_age`**: Validates age 13 or older

## CSS Styling

### Validation Styles (`public/css/validation.css`)

The validation system includes comprehensive CSS styling for:

- **Error States**: Red borders and icons for invalid fields
- **Success States**: Green borders and icons for valid fields
- **Password Strength**: Color-coded strength indicators
- **Animations**: Shake animation for errors, pulse for success
- **Responsive Design**: Mobile-friendly validation styling
- **Loading States**: Button loading indicators
- **Form Progress**: Multi-step form progress indicators

## Usage Examples

### Basic Form with Validation

```php
<!-- In your view file -->
<form method="post" action="<?= base_url('register') ?>" id="registerForm">
    <?= csrf_field() ?>
    
    <?= display_validation_errors() ?>
    
    <div class="input-field <?= get_field_class('name') ?>">
        <input type="text" name="name" value="<?= get_field_value('name') ?>" required>
        <?= display_field_error('name') ?>
        <?= display_field_help('name') ?>
    </div>
    
    <!-- More fields... -->
</form>
```

### Controller with Validation

```php
public function storeEvent()
{
    $validation = \Config\Services::validation();
    
    $validation->setRules([
        'title' => 'required|min_length[3]|max_length[255]',
        'event_date' => 'required|valid_date|check_future_date',
        'description' => 'required|min_length[10]|max_length[1000]'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $validation->getErrors());
    }

    // Process valid data
    $eventModel = new \App\Models\EventModel();
    $data = [
        'title' => $this->request->getPost('title'),
        'event_date' => $this->request->getPost('event_date'),
        'description' => $this->request->getPost('description'),
    ];
    
    try {
        $eventModel->insert($data);
        return redirect()->to('/admin/events')->with('success', 'Event created successfully');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to create event. Please try again.');
    }
}
```

## Security Features

### Input Sanitization

```php
// Sanitize different types of input
$email = sanitize_input($data['email'], 'email');
$name = sanitize_input($data['name'], 'string');
$amount = sanitize_input($data['amount'], 'float');
```

### File Upload Security

```php
// Validate file uploads
$errors = validate_file_upload(
    $file,
    ['jpg', 'jpeg', 'png', 'gif'],
    2048 // 2MB max
);
```

### XSS Protection

All output is automatically escaped using CodeIgniter's `esc()` function:

```php
echo esc($user_input);
```

## Best Practices

### 1. Always Validate Server-Side
- Client-side validation is for UX only
- Server-side validation is for security
- Never trust client-side data

### 2. Provide Clear Error Messages
- Use specific, actionable error messages
- Avoid technical jargon
- Provide helpful suggestions

### 3. Preserve User Input
- Use `old()` helper to repopulate forms
- Don't make users re-enter valid data
- Clear only invalid fields

### 4. Progressive Enhancement
- Forms work without JavaScript
- JavaScript enhances the experience
- Graceful degradation for older browsers

### 5. Consistent Validation
- Use the same rules client and server-side
- Maintain consistent error messages
- Follow established patterns

## Testing Validation

### Unit Tests

```php
public function testUserRegistrationValidation()
{
    $validation = \Config\Services::validation();
    $validation->setRules([
        'name' => 'required|min_length[2]|max_length[100]|alpha_space',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/]'
    ]);

    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'StrongPass123!'
    ];

    $this->assertTrue($validation->run($data));
}
```

### Integration Tests

```php
public function testRegistrationFormSubmission()
{
    $response = $this->post('/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'StrongPass123!',
        'confirm_password' => 'StrongPass123!',
        'membership_level' => 'Bronze',
        'terms' => '1'
    ]);

    $response->assertRedirect('/login');
    $response->assertSessionHas('success');
}
```

## Troubleshooting

### Common Issues

1. **Validation Rules Not Working**
   - Check if custom rules are loaded in `Validation.php`
   - Ensure rule names match exactly
   - Verify rule parameters are correct

2. **Client-Side Validation Not Working**
   - Check jQuery is loaded before validation script
   - Verify form has correct ID
   - Check browser console for JavaScript errors

3. **Error Messages Not Displaying**
   - Ensure validation helper is loaded
   - Check session flash data is set correctly
   - Verify error display functions are called

4. **File Upload Validation Issues**
   - Check file size limits in PHP configuration
   - Verify allowed file types
   - Ensure proper file permissions

### Debug Mode

Enable debug mode to see detailed validation information:

```php
// In your controller
if (!$validation->withRequest($this->request)->run()) {
    log_message('error', 'Validation failed: ' . json_encode($validation->getErrors()));
    return redirect()->back()
        ->withInput()
        ->with('errors', $validation->getErrors());
}
```

## Conclusion

The Chess Club validation system provides comprehensive data validation for both security and user experience. By implementing both server-side and client-side validation, the system ensures data integrity while providing immediate feedback to users.

Key benefits:
- **Security**: Server-side validation prevents malicious data
- **UX**: Client-side validation provides immediate feedback
- **Maintainability**: Centralized validation rules and helpers
- **Flexibility**: Custom validation rules for chess club needs
- **Consistency**: Uniform validation across all forms

For questions or issues with the validation system, refer to the CodeIgniter 4 documentation or contact the development team. 