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
       
        $cekIngredients = $ingredientModel->countAllResults();
        if ($cekIngredients == 0)
        {
            $notFound = "bahan belum ada";

            session()->setFlashdata('notfound',$notFound);

            return redirect()->to('products');
        }

     
        
        echo view("autoviews/MainHeader", $data);
        echo view('recipes/AddRecipes', $data);
        echo view("autoviews/MainFooter", $data);
        
    }

   
    public function storeRecipe($product_id)
{
    helper('form');
    $recipesModel = new RecipesModel();
    $ingredientModel = new IngredientsModel();
    $productModel = new ProductsModel();
    $session = session();

    if ($session->has('name')) {
        $userName = $session->get('name');
    } else {
        return redirect()->to('loginadmin');
    }
    $data['userName'] = $userName;

    $cekIngredients = $ingredientModel->countAllResults();
    if ($cekIngredients == 0) {
        $no_r = "belum ada bahan";
        $session->setFlashdata('no_r', $no_r);
        return redirect()->to('/products');
    }

    $ingredients = $this->request->getPost('ingredients');
    $amounts = $this->request->getPost('amount');


     if (empty($ingredients) || empty($amounts)) {
        $no_n = 'Ingredients dan amount harus diisi';
        $session->setFlashdata('no_n', $no_n);
        return redirect()->back()->withInput();
    }

 
    $combined_ingredients = [];
    $combined_amounts = [];
    foreach ($amounts as $ingredient_id => $amount) {
        if (!empty($amount)) {

            if ($amount < 1) {
                $no_n = 'Amount untuk ' . $ingredientModel->find($ingredient_id)['ingredients_name'] . ' tidak boleh kurang dari 1';
                session()->setFlashdata('no_n', $no_n);
                return redirect()->back()->withInput();
            }
            
            $ingredient = $ingredientModel->find($ingredient_id);
            if ($ingredient && $ingredient['stock'] >= $amount) {
                $combined_ingredients[] = $ingredient_id;
                $combined_amounts[] = $amount;
            } else {
                $no_n = 'Jumlah takaran yang dimasukkan untuk ' . $ingredient['ingredients_name'] . ' melebihi jumlah stock';
                session()->setFlashdata('no_n', $no_n);
                return redirect()->back()->withInput();
            }
        }
    }

    if (!empty($combined_ingredients)) {
        $ingredients_string = implode(',', $combined_ingredients);
        $amounts_string = implode(',', $combined_amounts);

        $data = [
            'products_id' => $product_id,
            'ingredients' => $ingredients_string,
            'amount' => $amounts_string,
        ];

        $recipesModel->save($data);
        return redirect()->to('/products');
    }

    else {
        $no_n = 'Jumlah takaran yang dimasukkan tidak valid';
        session()->setFlashdata('no_n', $no_n);
        return redirect()->back()->withInput();
    }
}


public function editRecipe($productId)
{
    $recipesModel = new RecipesModel();
    $ingredientModel = new IngredientsModel();
   

   
    $session = session();
    if ($session->has('name')) {
        $userName = $session->get('name');
    } else {
        return redirect()->to('loginadmin');
    }

    $recipe = $recipesModel->where('products_id', $productId)->first();

    if (!$recipe) {
      
        return redirect()->back()->with('error', 'Resep untuk produk ini tidak ditemukan.');
    }

    
    $ingredients = $ingredientModel->findAll();

    
    $selectedIngredients = explode(',', $recipe['ingredients']);
    $selectedAmounts = explode(',', $recipe['amount']);

   
    if (count($selectedIngredients) !== count($selectedAmounts)) {
        
        return redirect()->back()->with('error', 'Data resep tidak valid. Jumlah bahan dan takaran tidak sesuai.');
    }

    
    $amounts = array_combine($selectedIngredients, $selectedAmounts);
   
    
    $data['recipe'] = $recipe;
    $data['productId'] = $productId;
    $data['ingredients'] = $ingredients;
    $data['selectedIngredients'] = $selectedIngredients;
    $data['amounts'] = $amounts;
    $data['userName'] = $userName;

   
    echo view("autoviews/MainHeader", $data);
    echo view('recipes/editRecipes', $data);
    echo view("autoviews/MainFooter", $data);
}
public function updateRecipe($productId)
{
    helper('form');
    $recipesModel = new RecipesModel();
    $ingredientModel = new IngredientsModel();
    $session = session();

  
    $recipe = $recipesModel->where('products_id', $productId)->first();

    if (!$recipe) {
        return redirect()->back()->with('error', 'Resep untuk produk ini tidak ditemukan.');
    }

    
    $ingredients = $this->request->getPost('ingredients');
    $amounts = $this->request->getPost('amount');

    if (empty($ingredients)) {
        
        $recipesModel->where('products_id', $productId)->delete();
        return redirect()->to('/products')->with('success', 'Resep telah dihapus.');
    }

    if (empty($amounts)) {
        return redirect()->back()->with('error', 'Amount harus diisi.');
    }

    
    $previousIngredients = explode(',', $recipe['ingredients']);
    $previousAmounts = explode(',', $recipe['amount']);
    
   
    $combinedIngredients = array_combine($previousIngredients, $previousAmounts);
    foreach ($amounts as $ingredient_id => $amount) {
        if (!empty($amount)) {
            if ($amount < 1) {
                $no_n = 'Amount untuk ' . $ingredientModel->find($ingredient_id)['ingredients_name'] . ' tidak boleh kurang dari 1';
                session()->setFlashdata('no_n', $no_n);
                return redirect()->back()->withInput();
            }

            $ingredient = $ingredientModel->find($ingredient_id);
            if ($ingredient && $ingredient['stock'] >= $amount) {
                $combinedIngredients[$ingredient_id] = $amount;
            } else {
                $no_n = 'Jumlah takaran yang dimasukkan untuk ' . $ingredient['ingredients_name'] . ' melebihi jumlah stock';
                session()->setFlashdata('no_n', $no_n);
                return redirect()->back()->withInput();
            }
        }
    }

    if (!empty($combinedIngredients)) {
        
        $newIngredients = array_keys($combinedIngredients);
        $newAmounts = array_values($combinedIngredients);

        $ingredients_string = implode(',', $newIngredients);
        $amounts_string = implode(',', $newAmounts);

        $data = [
            'products_id' => $productId,
            'ingredients' => $ingredients_string,
            'amount' => $amounts_string,
        ];

        
        $recipesModel->update($recipe['id'], $data);
        return redirect()->to('/products')->with('success', 'Resep telah diperbarui.');
    } else {
        $no_n = 'Jumlah takaran yang dimasukkan tidak valid';
        session()->setFlashdata('no_n', $no_n);
        return redirect()->back()->withInput();
    }
}



public function delete_recipes($id)
{
    $recipesModel = new RecipesModel();
    $recipesModel->where('id', $id)->delete($id);
    return $this->response->redirect(site_url('/products'));
}


public function detail($id)
{
    $recipesModel = new RecipesModel();
    $ingredientModel = new IngredientsModel();
    $productsModel = new ProductsModel();
    $session = session();

    $ingredient = $ingredientModel->find($id);

    if (!$ingredient) {
        return redirect()->back()->with('error', 'Bahan tidak ditemukan.');
    }

    $recipes = $recipesModel->findAll();
    $productsUsingIngredient = [];

    foreach ($recipes as $recipe) {
        $ingredientIds = explode(',', $recipe['ingredients']);
        if (in_array($id, $ingredientIds)) {
            $product = $productsModel->find($recipe['products_id']);
            if ($product) {
                $key = array_search($id, $ingredientIds);
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
public function removeIngredientFromAllProducts($ingredientId)
{
    $recipesModel = new RecipesModel();
    
    // Ambil semua resep yang menggunakan bahan ini
    $recipes = $recipesModel->like('ingredients', $ingredientId)->findAll();
    
    foreach ($recipes as $recipe) {
        // Pisahkan ingredients dan amounts ke dalam array
        $ingredientsArray = explode(',', $recipe['ingredients']);
        $amountsArray = explode(',', $recipe['amount']);
        
        // Cari index dari bahan yang ingin dihapus
        $index = array_search($ingredientId, $ingredientsArray);
        
        if ($index !== false) {
            // Hapus bahan dan jumlahnya dari array
            array_splice($ingredientsArray, $index, 1);
            array_splice($amountsArray, $index, 1);
            
            // Gabungkan kembali array menjadi string
            $newIngredients = implode(',', $ingredientsArray);
            $newAmounts = implode(',', $amountsArray);
            
            // Update resep dengan data yang baru
            $recipesModel->update($recipe['id'], [
                'ingredients' => $newIngredients,
                'amount' => $newAmounts,
            ]);
        }
    }
    
    return redirect()->back()->with('success', 'Bahan ini telah dihapus dari semua produk.');
}


}