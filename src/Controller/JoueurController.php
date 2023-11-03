<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;

class JoueurController extends Controller
{
    public function joueur()
    {
        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        var_dump($_SESSION);
        $this->display('joueur/joueur.html.twig'); 
    }
}