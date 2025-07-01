<?php
namespace App\Models;
use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'carts';
    protected $allowedFields = ['user_id', 'session_id', 'created_at', 'updated_at'];
} 