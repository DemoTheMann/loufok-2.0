<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;

class LoginController extends Controller
{
    public function login()
    {

      $loginModel = Login::getInstance();
      $joueurs = $loginModel->returnAll();

      if($_SERVER['REQUEST_METHOD'] === 'POST')
      {

        $admin = $loginModel->authAdmin($_POST['login'], $_POST['password']);
        if($admin) {
          $this->display('admin/index.html.twig', ['user' => $admin]);          
        };
        
        $joueur = $loginModel->authJoueur($_POST['login'], $_POST['password']);
        if($joueur){
          $this->display('joueur/index.html.twig', ['user' => $joueur]);
        };

      }else{
        $this->display('login.html.twig');
      }

    }
}