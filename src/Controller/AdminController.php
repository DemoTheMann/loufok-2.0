<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;

class AdminController extends Controller
{
    public function admin()
    {
        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        var_dump($_SESSION);
        $this->display('admin/admin.html.twig');
    }
}