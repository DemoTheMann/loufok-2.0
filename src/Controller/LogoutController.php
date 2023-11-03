<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;

class LogoutController extends Controller
{
    public function logout()
    {
        session_start();

        $loginModel = Login::getInstance();
        $loginModel->logout();
        HTTP::redirect('/loufok/login');
    }
}