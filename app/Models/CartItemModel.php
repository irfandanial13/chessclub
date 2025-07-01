<?php
namespace App\Models;
use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table = 'cart_items';
    protected $allowedFields = ['cart_id', 'item_id', 'quantity', 'price'];
} 