<?php 

namespace App\Models;

use CodeIgniter\Model;

class RecipesModel extends Model {

    protected $table = "recipes";
    protected $primaryKey = 'id';

    protected $allowedFields = ['products_id', 'ingredients','amount'];

    protected bool $allowEmptyInserts = false;

    // public function getRecipesWithProducts()
    // {
    //     return $this->select('recipes.*, produk.nama_produk AS product_name')
    //                 ->join('produk', 'produk.id = recipes.products_id')
    //                 ->findAll();
    // }

    public function getRecipeById($id = null)
    {
        return $this->select('recipes.*, produk.nama_produk AS product_name')
                    ->join('produk', 'produk.id = recipes.products_id')
                    ->where('recipes.id', $id)
                    ->first();
    }

    public function getRecipesWithProducts()
    {
        $builder = $this->db->table('recipes'); 
        $builder->select('recipes.*, produk.nama_produk');
        $builder->join('produk', 'produk.id = recipes.products_id');
        $builder->orderBy('recipes.id', 'DESC');
    
    
    
        return $builder->get()->getResultArray();
    }


    public function detail($ingredientId)
    {
        $recipesModel = new RecipesModel();
        $ingredientModel = new IngredientsModel();
        $productsModel = new ProductsModel();
        $session = session();

        $ingredient = $ingredientModel->find($ingredientId);

        if (!$ingredient) {
            return redirect()->back()->with('error', 'Bahan tidak ditemukan.');
        }

        $recipes = $recipesModel->findAll();
        $productsUsingIngredient = [];

        foreach ($recipes as $recipe) {
            $ingredientIds = explode(',', $recipe['ingredients']);
            if (in_array($ingredientId, $ingredientIds)) {
                $product = $productsModel->find($recipe['products_id']);
                if ($product) {
                    $key = array_search($ingredientId, $ingredientIds);
                    $amounts = explode(',', $recipe['amount']);
                    $productsUsingIngredient[] = [
                        'nama_produk' => $product['nama_produk'],
                        'foto' => $product['foto'],
                        'amount' => $amounts[$key],
                        'unit' => $ingredient['unit'],
                    ];
                }
            }
        }

        $data = [
            'ingredient' => $ingredient,
            'products' => $productsUsingIngredient
        ];

        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }

        $data['userName'] = $userName;

        echo view('autoviews/MainHeader', $data);
        echo view('recipes/Detail', $data);
        echo view('autoviews/MainFooter', $data);
    }
    
}