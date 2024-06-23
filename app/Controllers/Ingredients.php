<?php
namespace App\Controllers;

use App\Models\IngredientsModel;
use App\Models\RecipesModel;
use App\Models\ProductsModel;


class Ingredients extends BaseController
{

    public function index()
    {
       $IngredientsModel = new IngredientsModel();
        $session = session();

        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }

        $data['ingredients'] = $IngredientsModel ->findAll();
        $data['userName'] = $userName;
       
       
        $cek = $IngredientsModel->countAllResults();

        if($cek == 0)
        {
            $empty = "Ups !! belum Ada Bahan";
            $notFound = $session->setFlashdata("emptybahan",$empty);
          
        }

    
        echo view("autoviews/MainHeader", $data);
        echo view("ingredients/IngredientsView", $data);
        echo view("autoviews/MainFooter", $data);
    }


    
public function create_ingredients()

{
    
    helper('form');
    $session = session();

    if ($session->has('name')) {
        $userName = $session->get('name');
    } else {
        return redirect()->to('loginadmin');
    }

    $data['userName'] = $userName;

    echo view("autoviews/MainHeader", $data);
    echo view("ingredients/AddIngredients", $data);
    echo view("autoviews/MainFooter", $data);
}

public function store_ingredients()
{
    helper('form');
  
    $IngredientsModel = new IngredientsModel();

    $val = $this->validate([
        'ingredients_name' => [
            'label' => 'Nama Bahan',
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Bahan harus diisi.'
            ]
        ],
        'stock' => [
            'label' => 'stock',
            'rules' => 'required|numeric|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'stock harus diisi.',
                'numeric' => 'stock harus berupa numeric.',
                'greater_than_equal_to' => 'stock Tidak Boleh Minus.',
               
             
            ]
        ],
        'unit' => [
            'label' => 'unit',
            'rules' => 'required',
            'errors' => [
                'required' => 'satuan unit harus dipilih.',
               
             
            ]
        ],
       
        'harga_beli' => [
            'label' => 'harga beli',
            'rules' => 'required|numeric|greater_than_equal_to[1]',
            'errors' => [
                'required' => 'Harga beli harus diisi.',
                'numeric' => 'Harga beli harus berupa numeric.',
                'greater_than_equal_to' => 'Harga harus valid.',
               
             
            ]
        ],
       
       
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
        echo view("ingredients/AddIngredients", $data);
        echo view("autoviews/MainFooter", $data);
    } else {
       
            $data = [
                'ingredients_name' => $this->request->getVar('ingredients_name'),
                'stock' => $this->request->getVar('stock'),
                'unit' => $this->request->getVar('unit'),
                'description' => $this->request->getVar('description'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                
                
             
            ];

            if ($IngredientsModel->insert($data)) {
           
                echo "Data inserted successfully.";
            } else {
              
                echo "Data insert failed.";
                print_r($IngredientsModel->errors());
            }

            return $this->response->redirect(site_url('/ingredients'));
     
           
        
    }
}


public function edit($id)
{
    helper('form');
  
    $ingredientsModel = new IngredientsModel();
    $session = session();

        $ingredient = $ingredientsModel->find($id);
        if (!$ingredient) {
            return redirect()->to('/ingredients')->with('error', 'Product not found.');
        }

     
        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
            return redirect()->to('loginadmin');
        }

        $data['ingredients'] = $ingredientsModel->find($id);
        $data['userName'] = $userName;
       

       

        echo view("autoviews/MainHeader", $data);
        echo view("ingredients/EditIngredientsView", $data);
        echo view("autoviews/MainFooter", $data);
    
}


public function update_ingredients($id)
{
    helper('form');
  
    $IngredientsModel = new IngredientsModel();

    $val = $this->validate([
        'ingredients_name' => [
            'label' => 'Nama Bahan',
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Bahan harus diisi.'
            ]
        ],
        'stock' => [
            'label' => 'stock',
            'rules' => 'required|numeric|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'stock harus diisi.',
                'numeric' => 'stock harus berupa numeric.',
                'greater_than_equal_to' => 'stock Tidak Boleh Minus.',
               
             
            ]
        ],
        'unit' => [
            'label' => 'unit',
            'rules' => 'required',
            'errors' => [
                'required' => 'satuan unit harus dipilih.',
               
             
            ]
        ],
       
        'harga_beli' => [
            'label' => 'harga beli',
            'rules' => 'required|numeric|greater_than_equal_to[1]',
            'errors' => [
                'required' => 'Harga beli harus diisi.',
                'numeric' => 'Harga beli harus berupa numeric.',
                'greater_than_equal_to' => 'Harga harus valid.',
               
             
            ]
        ],
       
       
    ]);

 
   
    $session = session();

    if ($session->has('name')) {
        $userName = $session->get('name');
    } else {
        return redirect()->to('loginadmin');
    }

    $data['userName'] = $userName;

    if (!$val) {

        $data['ingredients'] = $IngredientsModel->find($id);
        $data['validation'] = $this->validator;

        echo view("autoviews/MainHeader", $data);
        echo view("ingredients/EditIngredientsView", $data);
        echo view("autoviews/MainFooter", $data);
    } else {
       

            $data = [
                'ingredients_name' => $this->request->getVar('ingredients_name'),
                'stock' => $this->request->getVar('stock'),
                'unit' => $this->request->getVar('unit'),
                'description' => $this->request->getVar('description'),
                'harga_beli' => $this->request->getVar('harga_beli'),
               
                
             
            ];

            if ($IngredientsModel->update($id,$data)) {
           
                echo "Data inserted successfully.";
            } else {
              
                echo "Data insert failed.";
                print_r($IngredientsModel->errors());
            }

            return $this->response->redirect(site_url('/ingredients'));
        
        
    }
}


//     public function uploadFiles()
// {
//     helper(['form', 'url']);

//     $msg = 'Please select valid files';

//     if ($this->request->getFileMultiple('images')) {
//         foreach ($this->request->getFileMultiple('images') as $file) {
            
//             if ($file->isValid() && !$file->hasMoved()) {
              
//                 $newName = $file->getRandomName();

               
//                 $file->move(WRITEPATH . 'uploads', $newName);

               
//                 $data = [
//                     'foto' => $newName,
                   
//                 ];

               
//                 $save = $db->insert($data);
//                 $msg = 'Files have been successfully uploaded';
//             } else {
//                 $msg = 'There was an error uploading the file: ' . $file->getErrorString();
//             }
//         }
//     }

//     return redirect()->back()->with('message', $msg);
// }




public function delete_ingredients($id)
{
    $ingredientModel = new IngredientsModel();
    $ingredientModel->where('id', $id)->delete($id);
    return $this->response->redirect(site_url('/ingredients'));
}




}