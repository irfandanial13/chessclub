<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'session_id',
        'total'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'session_id' => 'permit_empty|max_length[255]',
        'total' => 'required|decimal'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'integer' => 'User ID must be a number'
        ],
        'total' => [
            'required' => 'Total amount is required',
            'decimal' => 'Total amount must be a valid decimal number'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get orders with user information and order items
     */
    public function getOrdersWithDetails($limit = null, $offset = 0)
    {
        $builder = $this->db->table('orders o');
        $builder->select('o.*, u.name as user_name, u.email as user_email');
        $builder->join('users u', 'u.id = o.user_id', 'left');
        $builder->orderBy('o.created_at', 'DESC');
        
        if ($limit) {
            $builder->limit($limit, $offset);
        }
        
        $orders = $builder->get()->getResultArray();
        
        // Get order items for each order
        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItems($order['id']);
        }
        
        return $orders;
    }

    /**
     * Get order items for a specific order
     */
    public function getOrderItems($orderId)
    {
        $builder = $this->db->table('order_items oi');
        $builder->select('oi.*');
        $builder->where('oi.order_id', $orderId);
        
        $items = $builder->get()->getResultArray();
        
        // Add item names from static data
        $merchModel = new \App\Models\MerchandiseModel();
        foreach ($items as &$item) {
            $merchItem = $merchModel->getItem($item['item_id']);
            $item['item_name'] = $merchItem ? $merchItem['name'] : 'Unknown Item';
            $item['item_description'] = $merchItem ? $merchItem['description'] : '';
        }
        
        return $items;
    }

    /**
     * Get order statistics
     */
    public function getOrderStats()
    {
        $stats = [];
        
        // Total orders
        $stats['total_orders'] = $this->countAll();
        
        // Total revenue
        $revenue = $this->select('SUM(total) as total_revenue')
                       ->get()
                       ->getRow();
        $stats['total_revenue'] = $revenue ? $revenue->total_revenue : 0;
        
        // Average order value
        $avgOrder = $this->select('AVG(total) as avg_order')
                        ->get()
                        ->getRow();
        $stats['avg_order_value'] = $avgOrder ? $avgOrder->avg_order : 0;
        
        // Recent orders (last 30 days)
        $recentOrders = $this->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')))
                            ->countAllResults();
        $stats['recent_orders'] = $recentOrders;
        
        return $stats;
    }

    /**
     * Get orders by user ID
     */
    public function getOrdersByUser($userId)
    {
        $orders = $this->where('user_id', $userId)
                      ->orderBy('created_at', 'DESC')
                      ->findAll();
        
        // Get order items for each order
        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItems($order['id']);
        }
        
        return $orders;
    }

    /**
     * Create order with items
     */
    public function createOrderWithItems($orderData, $items)
    {
        $this->db->transStart();
        
        // Insert order
        $orderId = $this->insert($orderData);
        
        // Insert order items
        if ($orderId && !empty($items)) {
            $orderItemModel = new \App\Models\OrderItemModel();
            foreach ($items as $item) {
                $item['order_id'] = $orderId;
                $orderItemModel->insert($item);
            }
        }
        
        $this->db->transComplete();
        
        return $this->db->transStatus() ? $orderId : false;
    }

    /**
     * Get order with full details
     */
    public function getOrderWithDetails($orderId)
    {
        $order = $this->find($orderId);
        if ($order) {
            $order['items'] = $this->getOrderItems($orderId);
            
            // Get user details
            $userModel = new \App\Models\UserModel();
            $order['user'] = $userModel->find($order['user_id']);
        }
        
        return $order;
    }
} 