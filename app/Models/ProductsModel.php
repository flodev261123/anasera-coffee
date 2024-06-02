<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model {

    protected $table = "produk";
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_produk', 'category', 'harga_satuan', 'foto','unit', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    public function getProductsWithCategory()
    {
        return $this->select('produk.*, category.category_name')
                    ->join('category', 'category.id = produk.category')
                    ->orderBy('produk.id', 'DESC')
                    ->findAll();
    }
    
}