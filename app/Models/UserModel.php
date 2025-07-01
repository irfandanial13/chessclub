<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * UserModel
 *
 * Passwords are hashed using password_hash() on registration and verified using password_verify() on login.
 */
class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'password', 'membership_level', 'status', 'created_at', 'points', 'honor_points'
    ];
}
