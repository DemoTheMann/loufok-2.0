<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\JoueurModel;
use DateTime;

class JoueurController extends Controller
{
    public function joueur()
    {
        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        $id_joueur = $_SESSION['user_id'];

        $joueurModel = JoueurModel::getInstance();
        // $cadavreModel = CadavreModel::getInstance();

        $title = false;
        $latest = false;
        
        $current_cadavre = $joueurModel->getActiveCadavre();

        if($current_cadavre)
        {
            $title = $current_cadavre['titre_cadavre'];

            $contribAleatoire = $joueurModel->getRandom($id_joueur);

            if(!$contribAleatoire)
            {
                $contribAleatoire = $joueurModel->setRandom($id_joueur);
            }
        }

        
        var_dump($_SESSION['user_id']);
        var_dump($current_cadavre['id_cadavre']);
        var_dump($contribAleatoire);
        
        $data= [
            "title" => $title,
            "latest" => $latest
        ];
        $this->display('joueur/joueur.html.twig',$data);
    }
}