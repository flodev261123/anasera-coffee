<?php 

namespace App\Models;

use CodeIgniter\Model;

class RecipesModel extends Model {

    protected $table = "recipes";
    protected $primaryKey = 'id';

    protected $allowedFields = ['products_id', 'ingredients','amount'];

    protected bool $allowEmptyInserts = false;

    public function getRecipesWithProducts()
    {
        return $this->select('recipes.*, produk.nama_produk AS product_name')
                    ->join('products', 'produk.id = recipes.products_id')
                    ->findAll();
    }

    public function getRecipeById($id)
    {
        return $this->select('recipes.*, produk.nama_produk AS product_name')
                    ->join('products', 'produk.id = recipes.products_id')
                    ->where('recipes.id', $id)
                    ->first();
    }
    
}