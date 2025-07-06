<?php
namespace App\Models;
use CodeIgniter\Model;

class MerchandiseModel extends Model
{
    // For now, use static data. Replace with DB logic if needed.
    public function getAllMerchandise()
    {
        return [
            [
                'id' => 1,
                'name' => 'Chess Club T-Shirt',
                'price' => 25.00,
                'image' => base_url('images/merch_tshirt.jpg'),
                'description' => 'Premium cotton T-shirt Chess Club design.'
            ],
            [
                'id' => 2,
                'name' => 'Chess Mug',
                'price' => 12.00,
                'image' => base_url('images/merch_mug.jpg'),
                'description' => 'Ceramic mug with chess piece design.'
            ],
            [
                'id' => 3,
                'name' => 'Chess Set',
                'price' => 40.00,
                'image' => base_url('images/merch_set.jpg'),
                'description' => 'Classic chess set for club members.'
            ],
        ];
    }

    public function getItem($id)
    {
        foreach ($this->getAllMerchandise() as $item) {
            if ($item['id'] == $id) return $item;
        }
        return null;
    }
} 