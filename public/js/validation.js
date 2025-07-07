/**
 * Chess Club Validation Scripts
 * Client-side validation using jQuery Validation plugin
 */

$(document).ready(function() {
    
    // Custom validation methods
    $.validator.addMethod("strongPassword", function(value, element) {
        return this.optional(element) || 
               /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/.test(value);
    }, "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.");

    $.validator.addMethod("futureDate", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        var today = new Date();
        var inputDate = new Date(value);
        return inputDate > today;
    }, "Date must be in the future.");

    $.validator.addMethod("validAmount", function(value, element) {
        return this.optional(element) || 
               /^\d+(\.\d{1,2})?$/.test(value) && parseFloat(value) > 0 && parseFloat(value) <= 999999.99;
    }, "Please enter a valid amount (max 999,999.99).");

    $.validator.addMethod("validPhone", function(value, element) {
        var phone = value.replace(/[^0-9]/g, '');
        return this.optional(element) || (phone.length >= 10 && phone.length <= 15);
    }, "Please enter a valid phone number.");

    $.validator.addMethod("validPostalCode", function(value, element) {
        var postal = value.replace(/[^0-9]/g, '');
        return this.optional(element) || postal.length === 5;
    }, "Please enter a valid 5-digit postal code.");

    // Login Form Validation
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 1
            }
        },
        messages: {
            email: {
                required: "Email address is required.",
                email: "Please enter a valid email address."
            },
            password: {
                required: "Password is required."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.input-field').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.input-field').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

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
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            membership_level: {
                required: true
            },
            terms: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Full name is required.",
                minlength: "Name must be at least 2 characters long.",
                maxlength: "Name cannot exceed 100 characters.",
                pattern: "Name can only contain letters and spaces."
            },
            email: {
                required: "Email address is required.",
                email: "Please enter a valid email address."
            },
            password: {
                required: "Password is required.",
                minlength: "Password must be at least 8 characters long.",
                maxlength: "Password cannot exceed 255 characters."
            },
            confirm_password: {
                required: "Please confirm your password.",
                equalTo: "Passwords do not match."
            },
            membership_level: {
                required: "Please select a membership level."
            },
            terms: {
                required: "You must agree to the terms and conditions."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.input-field').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.input-field').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // Event Form Validation
    $("#eventForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            event_date: {
                required: true,
                futureDate: true
            },
            description: {
                required: true,
                minlength: 10,
                maxlength: 1000
            }
        },
        messages: {
            title: {
                required: "Event title is required.",
                minlength: "Event title must be at least 3 characters long.",
                maxlength: "Event title cannot exceed 255 characters."
            },
            event_date: {
                required: "Event date is required."
            },
            description: {
                required: "Event description is required.",
                minlength: "Event description must be at least 10 characters long.",
                maxlength: "Event description cannot exceed 1000 characters."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.form-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.form-group').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // Merchandise Form Validation
    $("#merchandiseForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            description: {
                required: true,
                minlength: 10,
                maxlength: 1000
            },
            price: {
                required: true,
                validAmount: true
            },
            stock_quantity: {
                required: true,
                digits: true,
                min: 0
            }
        },
        messages: {
            name: {
                required: "Product name is required.",
                minlength: "Product name must be at least 2 characters long.",
                maxlength: "Product name cannot exceed 255 characters."
            },
            description: {
                required: "Product description is required.",
                minlength: "Product description must be at least 10 characters long.",
                maxlength: "Product description cannot exceed 1000 characters."
            },
            price: {
                required: "Product price is required."
            },
            stock_quantity: {
                required: "Stock quantity is required.",
                digits: "Stock quantity must be a whole number.",
                min: "Stock quantity cannot be negative."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.form-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.form-group').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // User Profile Form Validation
    $("#profileForm").validate({
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
            phone: {
                validPhone: true
            },
            postal_code: {
                validPostalCode: true
            }
        },
        messages: {
            name: {
                required: "Full name is required.",
                minlength: "Name must be at least 2 characters long.",
                maxlength: "Name cannot exceed 100 characters.",
                pattern: "Name can only contain letters and spaces."
            },
            email: {
                required: "Email address is required.",
                email: "Please enter a valid email address."
            },
            phone: {
                validPhone: "Please enter a valid phone number."
            },
            postal_code: {
                validPostalCode: "Please enter a valid 5-digit postal code."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.input-field').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.input-field').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // Password Change Form Validation
    $("#passwordForm").validate({
        rules: {
            current_password: {
                required: true
            },
            new_password: {
                required: true,
                minlength: 8,
                maxlength: 255,
                strongPassword: true
            },
            confirm_new_password: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_password: {
                required: "Current password is required."
            },
            new_password: {
                required: "New password is required.",
                minlength: "Password must be at least 8 characters long.",
                maxlength: "Password cannot exceed 255 characters."
            },
            confirm_new_password: {
                required: "Please confirm your new password.",
                equalTo: "Passwords do not match."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.input-field').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.input-field').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // Contact Form Validation
    $("#contactForm").validate({
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
            subject: {
                required: true,
                minlength: 5,
                maxlength: 200
            },
            message: {
                required: true,
                minlength: 10,
                maxlength: 1000
            }
        },
        messages: {
            name: {
                required: "Your name is required.",
                minlength: "Name must be at least 2 characters long.",
                maxlength: "Name cannot exceed 100 characters.",
                pattern: "Name can only contain letters and spaces."
            },
            email: {
                required: "Email address is required.",
                email: "Please enter a valid email address."
            },
            subject: {
                required: "Subject is required.",
                minlength: "Subject must be at least 5 characters long.",
                maxlength: "Subject cannot exceed 200 characters."
            },
            message: {
                required: "Message is required.",
                minlength: "Message must be at least 10 characters long.",
                maxlength: "Message cannot exceed 1000 characters."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.input-field').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.input-field').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // Payment Upload Form Validation
    $("#paymentForm").validate({
        rules: {
            payment_proof: {
                required: true,
                extension: "jpg|jpeg|png|gif"
            },
            amount: {
                required: true,
                validAmount: true
            },
            payment_method: {
                required: true
            }
        },
        messages: {
            payment_proof: {
                required: "Please select a payment proof file.",
                extension: "Please upload an image file (JPG, JPEG, PNG, GIF)."
            },
            amount: {
                required: "Payment amount is required."
            },
            payment_method: {
                required: "Payment method is required."
            }
        },
        errorClass: "validation-error",
        validClass: "validation-success",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.form-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.form-group').removeClass('error');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    // Real-time password strength indicator
    $("#password, #new_password").on('keyup', function() {
        var password = $(this).val();
        var strength = 0;
        var feedback = [];

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[@$!%*?&]/.test(password)) strength++;

        var strengthText = '';
        var strengthClass = '';

        switch(strength) {
            case 0:
            case 1:
                strengthText = 'Very Weak';
                strengthClass = 'very-weak';
                break;
            case 2:
                strengthText = 'Weak';
                strengthClass = 'weak';
                break;
            case 3:
                strengthText = 'Medium';
                strengthClass = 'medium';
                break;
            case 4:
                strengthText = 'Strong';
                strengthClass = 'strong';
                break;
            case 5:
                strengthText = 'Very Strong';
                strengthClass = 'very-strong';
                break;
        }

        // Update password strength indicator
        var indicator = $(this).siblings('.password-strength');
        if (indicator.length === 0) {
            indicator = $('<div class="password-strength"></div>');
            $(this).after(indicator);
        }

        indicator.html('<span class="strength-' + strengthClass + '">' + strengthText + '</span>');
    });

    // File upload validation
    $('input[type="file"]').on('change', function() {
        var file = this.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB
        var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

        if (file) {
            if (file.size > maxSize) {
                alert('File size cannot exceed 2MB.');
                $(this).val('');
                return false;
            }

            if (!allowedTypes.includes(file.type)) {
                alert('Please upload an image file (JPG, JPEG, PNG, GIF).');
                $(this).val('');
                return false;
            }
        }
    });

    // Auto-format phone numbers
    $('input[name="phone"]').on('input', function() {
        var value = $(this).val().replace(/[^0-9]/g, '');
        if (value.length > 0) {
            if (value.length <= 3) {
                value = value;
            } else if (value.length <= 6) {
                value = value.slice(0, 3) + '-' + value.slice(3);
            } else {
                value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
            }
        }
        $(this).val(value);
    });

    // Auto-format postal codes
    $('input[name="postal_code"]').on('input', function() {
        var value = $(this).val().replace(/[^0-9]/g, '');
        if (value.length > 5) {
            value = value.slice(0, 5);
        }
        $(this).val(value);
    });

    // Auto-format amounts
    $('input[name="price"], input[name="amount"]').on('input', function() {
        var value = $(this).val().replace(/[^0-9.]/g, '');
        var parts = value.split('.');
        if (parts.length > 2) {
            parts = [parts[0], parts.slice(1).join('')];
        }
        if (parts[1] && parts[1].length > 2) {
            parts[1] = parts[1].slice(0, 2);
        }
        $(this).val(parts.join('.'));
    });

    // Show/hide password toggle
    $('.password-toggle').on('click', function() {
        var input = $(this).siblings('input[type="password"]');
        var icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Form submission with loading state
    $('form').on('submit', function() {
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.text();
        
        if ($(this).valid()) {
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Processing...');
            
            // Re-enable after 5 seconds as fallback
            setTimeout(function() {
                submitBtn.prop('disabled', false);
                submitBtn.text(originalText);
            }, 5000);
        }
    });

    // Clear validation errors on input
    $('input, textarea, select').on('input change', function() {
        $(this).removeClass('validation-error').addClass('validation-success');
        $(this).closest('.input-field, .form-group').removeClass('error');
        $(this).siblings('.validation-error').remove();
    });

}); 