<?php
namespace App\Controllers;

use App\Models\LoginModel;

class LoginAdmin extends BaseController
{
    public function index()
    {

        helper("form");
        $LoginAdmin = new LoginModel();
        $login = $this->request->getPost("login");

        if ($login) {
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            $err = "";

            if (empty($username) && empty($password)) {
                $err = "Silahkan isi username dan password terlebih dahulu";
            } elseif (empty($username)) {
                $err = "Silahkan isi username terlebih dahulu";
            } elseif (empty($password)) {
                $err = "Silahkan isi password terlebih dahulu";
            }

            if (empty($err)) {
                $dataAdmin = $LoginAdmin->where("username", $username)->first();
                if (!$dataAdmin || $dataAdmin['password'] != md5($password)) {
                    $err = "password tidak sesuai";
                }
            }

            if (empty($err)) {
                $session = session();
                $sessionData = [
                    'id' => $dataAdmin['id'],
                    'name' => $dataAdmin['name'],
                    'username' => $dataAdmin['username'],
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);
                return redirect()->to('dashboard');
            }

            if ($err) {
              session()->setFlashdata('username' ,$username);
                session()->setFlashdata('error', $err);
                return redirect()->to("loginadmin");
            }
        }

        echo view("autoviews/LoginHeader");
        echo view("auth/LoginView");
        echo view("autoviews/footer");
    }

    

    public function logout()
    
 
    
        {
            $session = session();
            $session->destroy();
            $message = 'Berhasil Log Out';
            setcookie('logout_message', $message, time() + 60, '/');
            return redirect()->to('loginadmin');
        }
       
       
    }

  
    