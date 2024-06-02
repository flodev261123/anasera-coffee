<?php
namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\IngredientsModel;
use App\Models\ProductsModel;

class Recipes extends BaseController
{
    public function index($product_id)
    {
        $productModel = new ProductsModel();
        $ingredientModel = new IngredientsModel();
        $session = session();

        $data['product'] = $productModel->find($product_id);
        $data['ingredients'] = $ingredientModel->findAll();
        $data['product_id'] = $product_id;

        if (!$data['product']) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }
        $data['userName'] = $userName;

        echo view("autoviews/MainHeader", $data);
        echo view('recipes/AddRecipes', $data);
        echo view("autoviews/MainFooter", $data);
    }

    public function storeRecipe()
    {
        $recipesModel = new RecipesModel();
        $ingredientModel = new IngredientsModel();

  
        $product_id = $this->request->getPost('product_id');
        $ingredients = $this->request->getPost('ingredients');
        $amounts = $this->request->getPost('amount');

        $combined_ingredients = [];
        $combined_amounts = [];
        foreach ($ingredients as $ingredient_id) {
            if (isset($amounts[$ingredient_id]) && !empty($amounts[$ingredient_id])) {
                $combined_ingredients[] = $ingredient_id;
                $combined_amounts[] = $amounts[$ingredient_id];
            }
        }

        $ingredients_string = implode(',', $combined_ingredients);
        $amounts_string = implode(',', $combined_amounts);

        $data = [
            'products_id' => $product_id,
            'ingredients' => $ingredients_string,
            'amount' => $amounts_string
        ];

        $recipesModel->save($data);

        return redirect()->to('/products');
    }
}