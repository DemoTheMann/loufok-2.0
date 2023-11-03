<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;

class IndexController extends Controller
{
    public function index()
    {
        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        $this->display('joueur/index.html.twig'); 
    }
}