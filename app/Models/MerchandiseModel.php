<?php
namespace App\Models;
use CodeIgniter\Model;

class MerchandiseModel extends Model
{
    protected $table = 'merchandise';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'image', 'is_available', 'stock_quantity'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get all available merchandise (for public display)
    public function getAvailableMerchandise()
    {
        return $this->where('is_available', true)
                    ->where('stock_quantity >', 0)
                    ->findAll();
    }

    // Get all merchandise (for admin management)
    public function getAllMerchandise()
    {
        return $this->findAll();
    }

    public function getItem($id)
    {
        return $this->find($id);
    }

    // Toggle availability
    public function toggleAvailability($id)
    {
        $item = $this->find($id);
        if ($item) {
            $this->update($id, ['is_available' => !$item['is_available']]);
            return true;
        }
        return false;
    }

    // Update stock quantity
    public function updateStock($id, $quantity)
    {
        return $this->update($id, ['stock_quantity' => $quantity]);
    }

    // Get statistics
    public function getStats()
    {
        $total = $this->countAll();
        $available = $this->where('is_available', true)->countAllResults();
        $outOfStock = $this->where('stock_quantity', 0)->countAllResults();
        $lowStock = $this->where('stock_quantity >', 0)
                         ->where('stock_quantity <=', 5)
                         ->countAllResults();

        return [
            'total' => $total,
            'available' => $available,
            'out_of_stock' => $outOfStock,
            'low_stock' => $lowStock
        ];
    }
} 