<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Chess Club T-Shirt',
                'description' => 'Premium cotton T-shirt with exclusive Chess Club design. Available in multiple sizes.',
                'price' => 25.00,
                'stock' => 50,
                'category' => 'clothing',
                'status' => 'active',
                'image' => base_url('images/merch_tshirt.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Chess Club Mug',
                'description' => 'Ceramic mug with elegant chess piece design. Perfect for coffee or tea.',
                'price' => 12.00,
                'stock' => 30,
                'category' => 'accessories',
                'status' => 'active',
                'image' => base_url('images/merch_mug.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Professional Chess Set',
                'description' => 'High-quality wooden chess set with weighted pieces. Tournament standard.',
                'price' => 40.00,
                'stock' => 15,
                'category' => 'equipment',
                'status' => 'active',
                'image' => base_url('images/merch_set.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Chess Strategy Book',
                'description' => 'Comprehensive guide to chess strategies and tactics for all skill levels.',
                'price' => 18.50,
                'stock' => 25,
                'category' => 'books',
                'status' => 'active',
                'image' => base_url('images/chess_book.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Chess Clock',
                'description' => 'Digital chess clock with tournament features and easy-to-use interface.',
                'price' => 35.00,
                'stock' => 8,
                'category' => 'equipment',
                'status' => 'active',
                'image' => base_url('images/chess_clock.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Chess Club Cap',
                'description' => 'Stylish baseball cap with embroidered Chess Club logo.',
                'price' => 15.00,
                'stock' => 20,
                'category' => 'clothing',
                'status' => 'active',
                'image' => base_url('images/chess_cap.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('products')->insertBatch($data);
    }
} 