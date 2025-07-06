<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MerchandiseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Chess Club T-Shirt',
                'description' => 'Premium cotton T-shirt with exclusive Chess Club design. Available in various sizes.',
                'price' => 25.00,
                'image' => base_url('images/merch_tshirt.jpg'),
                'is_available' => true,
                'stock_quantity' => 50,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Mug',
                'description' => 'Ceramic mug featuring elegant chess piece design. Perfect for coffee or tea.',
                'price' => 12.00,
                'image' => base_url('images/merch_mug.jpg'),
                'is_available' => true,
                'stock_quantity' => 30,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Set',
                'description' => 'Classic wooden chess set for club members. Includes board and pieces.',
                'price' => 40.00,
                'image' => base_url('images/merch_set.jpg'),
                'is_available' => true,
                'stock_quantity' => 20,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Club Cap',
                'description' => 'Stylish cap with embroidered Chess Club logo. Adjustable fit.',
                'price' => 15.00,
                'image' => base_url('images/merch_cap.jpg'),
                'is_available' => true,
                'stock_quantity' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Timer',
                'description' => 'Digital chess timer for tournament play. Easy to use and reliable.',
                'price' => 35.00,
                'image' => base_url('images/merch_timer.jpg'),
                'is_available' => false,
                'stock_quantity' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Strategy Book',
                'description' => 'Comprehensive guide to chess strategies and tactics for all levels.',
                'price' => 18.00,
                'image' => base_url('images/merch_book.jpg'),
                'is_available' => true,
                'stock_quantity' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('merchandise')->insertBatch($data);
    }
} 