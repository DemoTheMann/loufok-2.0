<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;

class LogoutController extends Controller
{
    public function logout()
    {
        $loginModel = Login::getInstance();
        $loginModel->logout();
        $this->display('login.html.twig');
    }
}