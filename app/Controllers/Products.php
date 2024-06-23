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
        $categoryModel = new CategoryModel();
    
        $session = session();
    
        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }
    
        $category = $this->request->getGet('category');
    
      
        if ($category && $category != 'all') {
            $categoryData = $categoryModel->find($category);
            if ($categoryData) {
                $categoryName = $categoryData['category_name'];
                $products = $productsModel->getProductsWithCategory($category);
                if (empty($products)) {
                    $all = "Kategori '$categoryName' tidak memiliki produk yang tersedia.";
                    session()->setFlashdata("all", $all);
                } else {
                    $all = "Menampilkan semua produk dalam kategori '$categoryName'.";
                    session()->setFlashdata("all", $all);
                }
            } else {
                $all = "Kategori tidak ditemukan.";
                session()->setFlashdata("all", $all);
            }
        } else {
            $products = $productsModel->getProductsWithCategory();
            $all ="Menampilkan semua produk";
            session()->setFlashdata("all",$all);
        }
    
        foreach ($products as &$product) {
            $product['hasRecipe'] = $recipesModel->where('products_id', $product['id'])->first() !== null;
        }
    
        $recipes = $recipesModel->getRecipesWithProducts();
        
       
        $data['products'] = $products;
        $data['userName'] = $userName;
        $data['categories'] = $categoryModel->findAll();
        $data['recipes'] = $recipes;
    
        $cekProducts = $productsModel->countAllResults();
    
        if ($cekProducts == 0) {
            $empty = "Ups !! Data Masih Kosong";
            $notFound = $session->setFlashdata("empty", $empty);
        }
    
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



 
    public function delete($id)
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

    public function edit($id)
    {
        helper('form');
        $productsModel = new ProductsModel();
        $categoryModel = new CategoryModel();
        $ingredientsModel = new IngredientsModel();
        $session = session();
    
       
    
       
          
            $product = $productsModel->find($id);
    
            if (!$product) {
                return redirect()->to('/products')->with('error', 'Product not found.');
            }
    
          
            $session->setFlashdata('no_recipe', 'Product ini belum memiliki resep.');
    
            $data['product'] = $product;
            $data['categories'] = $categoryModel->findAll();
            $data['userName'] = $session->get('name');
    
            echo view("autoviews/MainHeader", $data);
            echo view("mainpages/EditProductView", $data);
            echo view("autoviews/MainFooter", $data);
        
    }
    

    
public function update($id)
{
    helper('form');
    $productsModel = new ProductsModel();
    $categoryModel = new CategoryModel();
    $ingredientsModel = new IngredientsModel();


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
            'rules' => 'required|numeric|greater_than_equal_to[1]',
            'errors' => [
                'required' => 'Harga Satuan harus diisi.',
                'numeric' => 'Harga Satuan harus berupa numeric.',
                'greater_than_equal_to' => 'Harga Tidak Valid.'
            ]
        ],
        'foto' => [
            'label' => 'Foto',
            'rules' => 'max_size[foto,10024]|ext_in[foto,jpg,jpeg,png]',
            'errors' => [
                'max_size' => 'Ukuran foto tidak boleh lebih dari 1GB.',
                'ext_in' => 'Foto harus dalam format jpg, jpeg, atau png.'
            ]
        ],
        'unit' => [
            'label' => 'satuan',
            'rules' => 'required',
            'errors' => [
                'required' => 'Satuan perunit harus diisi.'
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
        $product = $productsModel->find($id);
    
            if (!$product) {
                return redirect()->to('/products')->with('error', 'Product not found.');
            }
    
          
            $session->setFlashdata('no_recipe', 'Product ini belum memiliki resep.');
    
            $data['validation'] = $this->validator;
            $data['product'] = $product;
            $data['categories'] = $categoryModel->findAll();
            $data['userName'] = $session->get('name');
    
            echo view("autoviews/MainHeader", $data);
            echo view("mainpages/EditProductView_b", $data);
            echo view("autoviews/MainFooter", $data);
    } else {
        $product = $productsModel->find($id);

        if (!$product) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        $file = $this->request->getFile('foto');
        $newName = $product['foto'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move(FCPATH . 'uploads', $newName)) {
             
                if ($product['foto'] && file_exists(FCPATH . $product['foto'])) {
                    unlink(FCPATH . $product['foto']);
                }
                $newName = 'uploads/' . $newName; 
            } else {
                return redirect()->back()->with('error', 'File move failed.');
            }
        }

        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'category' => $this->request->getVar('category'),
            'harga_satuan' => $this->request->getVar('harga_satuan'),
            'foto' => $newName, // Use the existing or new photo path
            'unit' => $this->request->getVar('unit'),
            'update_at' => date('Y-m-d H:i:s')
        ];

        if ($productsModel->update($id, $data)) {
            return redirect()->to('/products')->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Data update failed.')->withInput();
        }
    }
}
// public function update_w_recipes($id)
// {
//     helper('form');
//     $productsModel = new ProductsModel();
//     $categoryModel = new CategoryModel();
//     $recipesModel = new RecipesModel();
//     $ingredientsModel = new IngredientsModel();

//     $val = $this->validate([
//         'nama_produk' => [
//             'label' => 'Nama Produk',
//             'rules' => 'required',
//             'errors' => [
//                 'required' => 'Nama Produk harus diisi.'
//             ]
//         ],
//         'category' => [
//             'label' => 'Category',
//             'rules' => 'required',
//             'errors' => [
//                 'required' => 'Category harus diisi.'
//             ]
//         ],
//         'harga_satuan' => [
//             'label' => 'Harga Satuan',
//             'rules' => 'required|numeric|greater_than_equal_to[1]',
//             'errors' => [
//                 'required' => 'Harga Satuan harus diisi.',
//                 'numeric' => 'Harga Satuan harus berupa numeric.',
//                 'greater_than_equal_to' => 'Harga Tidak Valid.'
//             ]
//         ],
//         'foto' => [
//             'label' => 'Foto',
//             'rules' => 'max_size[foto,10024]|ext_in[foto,jpg,jpeg,png]',
//             'errors' => [
//                 'max_size' => 'Ukuran foto tidak boleh lebih dari 1GB.',
//                 'ext_in' => 'Foto harus dalam format jpg, jpeg, atau png.'
//             ]
//         ],
//         'unit' => [
//             'label' => 'Stock',
//             'rules' => 'required',
//             'errors' => [
//                 'required' => 'Satuan perunit harus diisi.'
//             ]
//         ]
//     ]);

//     $session = session();

//     if ($session->has('name')) {
//         $userName = $session->get('name');
//     } else {
//         return redirect()->to('loginadmin');
//     }

//     $data['userName'] = $userName;

//     if (!$val) {
//         $recipe = $recipesModel->where('products_id', $id)->first();

//         $product = $productsModel->find($id);
    
//         if (!$product) {
//             return redirect()->to('/products')->with('error', 'Product not found.');
//         }
    
//         $ingredients = $ingredientsModel->findAll();
//         $recipe_ingredients = explode(',', $recipe['ingredients']);
//         $recipe_amounts = explode(',', $recipe['amount']);
          
//         $data = [
//             'product' => $product,
//             'recipe' => $recipe,
//             'recipe_ingredients' => $recipe_ingredients,
//             'recipe_amounts' => $recipe_amounts,
//             'ingredients' => $ingredients,
//             'categories' => $categoryModel->findAll(),
//             'userName' => $session->get('name'),
//         ];
//         $data['validation'] = $this->validator;

//         echo view("autoviews/MainHeader", $data);
//         echo view("mainpages/EditProductView", $data);
//         echo view("autoviews/MainFooter", $data);
//     } else {
//         $product = $productsModel->find($id);

//         if (!$product) {
//             return redirect()->to('/products')->with('error', 'Product not found.');
//         }

//         $file = $this->request->getFile('foto');
//         $newName = $product['foto'];

//         if ($file && $file->isValid() && !$file->hasMoved()) {
//             $newName = $file->getRandomName();
//             if ($file->move(FCPATH . 'uploads', $newName)) {
//                 if ($product['foto'] && file_exists(FCPATH . $product['foto'])) {
//                     unlink(FCPATH . $product['foto']);
//                 }
//                 $newName = 'uploads/' . $newName; 
//             } else {
//                 return redirect()->back()->with('error', 'File move failed.');
//             }
//         }

//         $data = [
//             'nama_produk' => $this->request->getVar('nama_produk'),
//             'category' => $this->request->getVar('category'),
//             'harga_satuan' => $this->request->getVar('harga_satuan'),
//             'foto' => $newName, 
//             'unit' => $this->request->getVar('unit'),
//             'update_at' => date('Y-m-d H:i:s')
//         ];

//         $productsModel->update($id, $data);

//         $ingredients = $this->request->getVar('ingredients');

//         if ($ingredients) {
//             foreach ($ingredients as $ingredient) {
//                 $ingredientStock = $ingredientsModel->find($ingredient['id'])['stock'];
//                 if ($ingredient['amount'] > $ingredientStock) {
//                     $ingredientName = $ingredientsModel->find($ingredient['id'])['ingredients_name'];
//                     return redirect()->back()->with('error', 'Amount yang dimasukkan untuk ' . $ingredientName . ' melebihi jumlah stok yang tersedia.');
//                 }
//             }

//             $ingredientIds = array_column($ingredients, 'id');
//             $amounts = array_column($ingredients, 'amount');

//             $recipeData = [
//                 'products_id' => $id,
//                 'ingredients' => implode(',', $ingredientIds),
//                 'amount' => implode(',', $amounts),
//             ];

//             $existingRecipe = $recipesModel->where('products_id', $id)->first();
//             if ($existingRecipe) {
//                 $recipesModel->update($existingRecipe['id'], $recipeData);
//             } else {
//                 $recipesModel->insert($recipeData);
//             }
//         } else {
//             $recipesModel->where('products_id', $id)->delete();
//         }

//         return redirect()->to('/products')->with('success', 'Data updated successfully.');
//     }
// }


}