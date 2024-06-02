<?php
namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CategoryModel;
use App\Models\RecipesModel ;
use App\Models\IngredientsModel ;

class Products extends BaseController
{
    public function index()
    {
        $productsModel = new ProductsModel();
        $recipesModel = new RecipesModel();
        $session = session();
    
        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }
    
        $products = $productsModel->getProductsWithCategory();
        foreach ($products as &$product) {
            $product['hasRecipe'] = $recipesModel->where('products_id', $product['id'])->first() !== null;
        }
    
        $data['products'] = $products;
        $data['userName'] = $userName;
    
        echo view("autoviews/MainHeader", $data);
        echo view("mainpages/ProductsView", $data);
        echo view("autoviews/MainFooter", $data);
    }
    


public function create()

{
    $categoryModel = new CategoryModel();
    $data['categories'] = $categoryModel->findAll();
    
    helper('form');
    $session = session();

    if ($session->has('name')) {
        $userName = $session->get('name');
    } else {
        return redirect()->to('loginadmin');
    }

    $data['userName'] = $userName;

    echo view("autoviews/MainHeader", $data);
    echo view("mainpages/AddProductView", $data);
    echo view("autoviews/MainFooter", $data);
}

    // Insert data
    public function store()
    {
        helper('form');
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        $productsModel = new ProductsModel();

        $val = $this->validate([
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi.'
                ]
            ],
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Category harus diisi.'
                ]
            ],
            'harga_satuan' => [
                'label' => 'Harga Satuan',
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Harga Satuan harus diisi.',
                    'numeric' => 'Harga Satuan harus berupa numeric.',
                    'greater_than_equal_to' => 'Harga Tidak Boleh Minus.',
                   
                 
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,10024]|ext_in[foto,jpg,jpeg,png]',
                'errors' => [
                    'uploaded' => 'Foto harus diunggah.',
                    'max_size' => 'Ukuran foto tidak boleh lebih dari 1GB.',
                    'ext_in' => 'Foto harus dalam format jpg, jpeg, atau png.'
                ]
            ],
            'unit' => [
                'label' => 'Stock',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan perunit harus diisi.',
                    
                 
                ]
            ]
        ]);

     
       
        $session = session();

        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }

        $data['userName'] = $userName;

        if (!$val) {

           
            $data['validation'] = $this->validator;

            echo view("autoviews/MainHeader", $data);
            echo view("mainpages/AddProductView", $data);
            echo view("autoviews/MainFooter", $data);
        } else {
            $file = $this->request->getFile('foto');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                if ($file->move(FCPATH . 'uploads', $newName)) {
                    
                    echo "File moved successfully: " . $newName;
                } else {
                
                    echo "File move failed.";
                    return;
                }

                $data = [
                    'nama_produk' => $this->request->getVar('nama_produk'),
                    'category' => $this->request->getVar('category'),
                    'harga_satuan' => $this->request->getVar('harga_satuan'),
                    'foto' => 'uploads/' . $newName,
                    'unit' => $this->request->getVar('unit'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s'),  
                ];

                if ($productsModel->insert($data)) {
               
                    echo "Data inserted successfully.";
                } else {
                  
                    echo "Data insert failed.";
                    print_r($productsModel->errors());
                }

                return $this->response->redirect(site_url('/products'));
            } else {
               
                $data['validation'] = $this->validator;
                $data['fileError'] = 'File upload failed, please try again.';

                echo view("autoviews/MainHeader", $data);
                echo view("mainpages/AddProductView", $data);
                echo view("autoviews/MainFooter", $data);
            }
        }
    }



 
    public function delete($id = null)
    {
        $productsModel = new ProductsModel();
        $productsModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/products'));
    }

    public function issueProduct($product_id)
    {
        $recipesModel = new RecipesModel();
        $productsModel = new ProductsModel();
        $ingredientsModel = new IngredientsModel();
        $session = session();
    
        $val = $this->validate([
            'quantity' => [
                'label' => 'quantity',
                'rules' => 'required|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'silahkan masukan jumlah terlebih dahulu',
                    'greater_than_equal_to' => 'masukan angka yang valid',
                ]
            ]
        ]);
    
        if (!$val) {
            $product = $productsModel->find($product_id);
    
            if ($session->has('name')) {
                $userName = $session->get('name');
            } else {
                return redirect()->to('loginadmin');
            }
        
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }
        
            $data['product'] = $product;
            $data['userName'] = $userName;
            $data['validation'] = $this->validator; 

            
    
            echo view("autoviews/MainHeader", $data);
            echo view("mainpages/ReduceIngredients", $data);
            echo view("autoviews/MainFooter", $data);
        } else {
            $recipe = $recipesModel->where('products_id', $product_id)->first();
    
            if (!$recipe) {
                return redirect()->back()->with('error', 'Recipe not found.');
            }
    
            $quantity = $this->request->getPost('quantity');
    
            $ingredients = explode(',', $recipe['ingredients']);
            $amounts = explode(',', $recipe['amount']);
    
            foreach ($ingredients as $index => $ingredient_id) {
                $amount_needed = $amounts[$index] * $quantity;
                $ingredientsModel->decreaseStock($ingredient_id, $amount_needed);
            }
    
            return redirect()->to('/products')->with('success', 'Product issued and ingredients stock updated.');
        }
    }
    

    public function Reduce ($product_id) {
        $productsModel = new ProductsModel();
        $product = $productsModel->find($product_id);
        $session = session();

        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        $data['product'] = $product;
        $data['userName'] = $userName;
      
       
        echo view("autoviews/MainHeader", $data);
        echo view("mainpages/ReduceIngredients", $data);
        echo view("autoviews/MainFooter", $data);
       
    }
}