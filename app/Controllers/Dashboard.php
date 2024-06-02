<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

       
        if ($session->has('name')) {
            $userName = $session->get('name');
        } else {
           
            return redirect()->to('loginadmin');
        }

        
        $data = [
            'userName' => $userName
        ];


        echo view("autoviews/MainHeader", $data);
        echo view("mainpages/DashboardView", $data);
        echo view("autoviews/MainFooter", $data);
    }
}