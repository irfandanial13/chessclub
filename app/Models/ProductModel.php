<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name', 
        'description', 
        'price', 
        'stock', 
        'category', 
        'status', 
        'image'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'price' => 'required|numeric|greater_than[0]',
        'stock' => 'required|integer|greater_than_equal_to[0]',
        'category' => 'required|in_list[clothing,accessories,equipment,books,general]',
        'status' => 'required|in_list[active,inactive]'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getProductsWithFilters($search = '', $category = '', $status = '')
    {
        $builder = $this->builder();
        
        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('description', $search)
                    ->groupEnd();
        }
        
        if (!empty($category)) {
            $builder->where('category', $category);
        }
        
        if (!empty($status)) {
            $builder->where('status', $status);
        }
        
        return $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
    }

    public function getProductStats()
    {
        $totalProducts = $this->countAllResults();
        $activeProducts = $this->where('status', 'active')->countAllResults();
        $lowStock = $this->where('stock <', 10)->countAllResults();
        
        // Calculate total value (price * stock)
        $result = $this->select('SUM(price * stock) as total_value')->first();
        $totalValue = $result['total_value'] ?? 0;
        
        return [
            'totalProducts' => $totalProducts,
            'activeProducts' => $activeProducts,
            'totalValue' => $totalValue,
            'lowStock' => $lowStock
        ];
    }
} 