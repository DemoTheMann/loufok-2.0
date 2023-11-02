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

        var_dump($_POST);

      }

      $this->display(
        'login.html.twig',
        [
            'joueurs' => '',
        ]
      );

    }
}