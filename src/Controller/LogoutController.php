<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\LoginModel;

class LogoutController extends Controller
{
    public function logout()
    {
        session_start();

        $loginModel = LoginModel::getInstance();
        $loginModel->logout();
        HTTP::redirect('/login');
    }
}