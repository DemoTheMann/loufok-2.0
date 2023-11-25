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
      }
      
      if(isset($_SESSION['auth']))
      {
        if($_SESSION['auth'] === true && $_SESSION['role'] === 'administrateur')
        {
          HTTP::redirect('/admin');
        }
        if($_SESSION['auth'] === true && $_SESSION['role'] === 'joueur')
        {
          HTTP::redirect('/joueur');
        }
      }

      $this->display('login.html.twig');
    }
}