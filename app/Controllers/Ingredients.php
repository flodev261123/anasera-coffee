<?php
namespace App\Controllers;

use App\Models\IngredientsModel;


class Ingredients extends BaseController
{
    // Show products list
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
                'required' => 'stock harus diisi.',
               
             
            ]
        ],
       
        'harga_beli' => [
            'label' => 'harga beli',
            'rules' => 'required|numeric|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'Harga beli harus diisi.',
                'numeric' => 'Harga beli harus berupa numeric.',
                'greater_than_equal_to' => 'Harga beli Tidak Boleh Minus.',
               
             
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
                'ingredients_name' => $this->request->getVar('ingredients_name'),
                'stock' => $this->request->getVar('stock'),
                'unit' => $this->request->getVar('unit'),
                'foto' => 'uploads/' . $newName,
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
        } else {
           
            $data['validation'] = $this->validator;
            $data['fileError'] = 'File upload failed, please try again.';

            echo view("autoviews/MainHeader", $data);
            echo view("ingredients/AddIngredients", $data);
            echo view("autoviews/MainFooter", $data);
        }
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


public function delete_ingredients($id = null)
{
    
    $IngredientsModel = new IngredientsModel();
    $IngredientsModel->where('id', $id)->delete($id);
    return $this->response->redirect(site_url('/ingredients'));
}

}