<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model {

    protected $table = "produk";
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_produk', 'category', 'harga_satuan', 'foto','unit', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    public function getProductsWithCategory($categoryId = null)
    {
        $builder = $this->db->table('produk'); 
        $builder->select('produk.*, category.category_name');
        $builder->join('category', 'category.id = produk.category');
        $builder->orderBy('produk.id', 'DESC');
    
        if ($categoryId !== null && $categoryId != 'all') {
            $builder->where('produk.category', $categoryId);
        }
    
        return $builder->get()->getResultArray();
    }

   
    
}