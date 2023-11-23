<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Model\JoueurModel;
use App\Model\CadavreModel;
use App\Model\ContributionModel;

use App\Helper\HTTP;
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

        if($_SESSION['role'] !== 'joueur')
        {
            HTTP::redirect('/loufok/login');
        }

        $userId = $_SESSION['user_id'];

        $joueurModel = JoueurModel::getInstance();
        $contribModel = ContributionModel::getInstance();
        $cadavreModel = CadavreModel::getInstance();

        $title = false;
        $latest = false;
        $user = "";
        
        $current_cadavre = $cadavreModel->cadavreEnCours();
        $user = $joueurModel->getUser($userId)[0];

        if($current_cadavre)
        {
            $title = $current_cadavre['titre_cadavre'];

            $contribAleatoire = $contribModel->getRandom($userId);

            if(!$contribAleatoire)
            {
                $contribAleatoire = $contribModel->setRandom($userId);
            }
        }

        
        if($joueurModel->getLatest($userId))
        {
            $latest = $joueurModel->getLatest($userId);
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

        if($_SESSION['role'] !== 'joueur')
        {
            HTTP::redirect('/loufok/login');
        }

        $userId = $_SESSION['user_id'];
        $joueurModel = JoueurModel::getInstance();
        $user = $joueurModel->getUser($userId)[0];

        $title = "";
        $contribs = "";

        $latest = $joueurModel->getLatest($userId);

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