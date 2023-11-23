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
        $user = "";
        
        $current_cadavre = $joueurModel->getActiveCadavre();
        $user = $joueurModel->getUser($id_joueur)[0];

        if($current_cadavre)
        {
            $title = $current_cadavre['titre_cadavre'];

            $contribAleatoire = $joueurModel->getRandom($id_joueur);

            if(!$contribAleatoire)
            {
                $contribAleatoire = $joueurModel->setRandom($id_joueur);
            }
        }

        
        if($joueurModel->getLatest($id_joueur))
        {
            $latest = $joueurModel->getLatest($id_joueur);
        }
        
        $data= [
            "title" => $title,
            "latest" => $latest,
            "user" => $user['nom_plume'],
        ];
        $this->display('joueur/joueur.html.twig',$data);
    }


    public function last()
    {

        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        $id_joueur = $_SESSION['user_id'];
        $joueurModel = JoueurModel::getInstance();
        $user = $joueurModel->getUser($id_joueur)[0];

        $title = "";
        $contribs = "";

        $latest = $joueurModel->getLatest($id_joueur);

        if(!$latest)
        {
            HTTP::redirect('/loufok');
        }

        $title = $latest['titre_cadavre'];
        $contribs = $joueurModel->getContribs($latest['id_cadavre']);

        $data= [
            "title" => $title,
            "contribs" => $contribs,
            "user" => $user['nom_plume'],
        ];
        $this->display('joueur/lastCadavre.html.twig',$data);
    }
}