<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\LoginModel;

class LoginController extends Controller
{
    public function login()
    {
      session_start();

      if($_SERVER['REQUEST_METHOD'] === 'POST')
      {
        $loginModel = LoginModel::getInstance();

        $loginModel->authAdmin($_POST['login'], $_POST['password']);
        $loginModel->authJoueur($_POST['login'], $_POST['password']);

        // if(!$admin && !$joueur)
        // {
        //   $this->display('login.html.twig');
        // }

      }
      
      if(isset($_SESSION['auth']))
      {
        if($_SESSION['auth'] === true && $_SESSION['role'] === 'admin')
        {
          HTTP::redirect('/loufok/admin');
        }
        if($_SESSION['auth'] === true && $_SESSION['role'] === 'joueur')
        {
          HTTP::redirect('/loufok/joueur');
        }
      }

      var_dump($_SESSION);
      $this->display('login.html.twig');
    }
}