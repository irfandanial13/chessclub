<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'order_id',
        'item_id',
        'quantity',
        'price'
    ];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'order_id' => 'required|integer',
        'item_id' => 'required|integer',
        'quantity' => 'required|integer|greater_than[0]',
        'price' => 'required|decimal'
    ];

    protected $validationMessages = [
        'order_id' => [
            'required' => 'Order ID is required',
            'integer' => 'Order ID must be a number'
        ],
        'item_id' => [
            'required' => 'Item ID is required',
            'integer' => 'Item ID must be a number'
        ],
        'quantity' => [
            'required' => 'Quantity is required',
            'integer' => 'Quantity must be a number',
            'greater_than' => 'Quantity must be greater than 0'
        ],
        'price' => [
            'required' => 'Price is required',
            'decimal' => 'Price must be a valid decimal number'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get order items with merchandise details
     */
    public function getOrderItemsWithDetails($orderId)
    {
        $builder = $this->db->table('order_items oi');
        $builder->select('oi.*');
        $builder->where('oi.order_id', $orderId);
        
        $items = $builder->get()->getResultArray();
        
        // Add item details from static data
        $merchModel = new \App\Models\MerchandiseModel();
        foreach ($items as &$item) {
            $merchItem = $merchModel->getItem($item['item_id']);
            $item['item_name'] = $merchItem ? $merchItem['name'] : 'Unknown Item';
            $item['item_description'] = $merchItem ? $merchItem['description'] : '';
            $item['item_image'] = $merchItem ? $merchItem['image'] : '';
        }
        
        return $items;
    }

    /**
     * Get items by order ID
     */
    public function getItemsByOrderId($orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }

    /**
     * Delete all items for an order
     */
    public function deleteByOrderId($orderId)
    {
        return $this->where('order_id', $orderId)->delete();
    }
} 