<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Entity\Cadavre;

class JoueurController extends Controller
{
    public function joueur()
    {
        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        $cadavreModel = Cadavre::getInstance();


        var_dump($_SESSION);

        $status = false;





        $data= [
            "status" => $status,
        ];
        $this->display('joueur/joueur.html.twig',$data);
    }
}