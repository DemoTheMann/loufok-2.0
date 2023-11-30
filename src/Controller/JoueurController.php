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
            HTTP::redirect('/login');
        }

        if($_SESSION['role'] !== 'joueur')
        {
            HTTP::redirect('/login');
        }

        $userId = $_SESSION['user_id'];

        $joueurModel = JoueurModel::getInstance();
        $contribModel = ContributionModel::getInstance();
        $cadavreModel = CadavreModel::getInstance();

        $title = false;
        $latest = false;
        $user = "";
        
        $current_cadavre = $cadavreModel->cadavreEnCours();
        $username = $joueurModel->getUserName($userId);
        
        if($current_cadavre)
        {
            $title = $current_cadavre['titre_cadavre'];
            
            $contribAleatoire = $contribModel->getRandom($userId);
            
            if(!$contribAleatoire)
            {
                $contribAleatoire = $contribModel->setRandom($userId);
            }
        }
        
        $latest = $joueurModel->getLatest($userId);
        
        $data= [
            "title" => $title,
            "latest" => $latest,
            "username" => $username,
        ];
        $this->display('joueur/joueur.html.twig',$data);
    }


    public function last()
    {

        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/login');
        }

        if($_SESSION['role'] !== 'joueur')
        {
            HTTP::redirect('/login');
        }

        $userId = $_SESSION['user_id'];
        $joueurModel = JoueurModel::getInstance();
        $contribModel = ContributionModel::getInstance();
        $username = $joueurModel->getUserName($userId);

        $title = "";
        $contribs = "";
        $latest = $joueurModel->getLatest($userId);
        if(!$latest)
        {
            HTTP::redirect('/');
        }

        $title = $latest['titre_cadavre'];
        $contribs = $contribModel->getContribs($latest['id_cadavre']);

        $data= [
            "title" => $title,
            "contribs" => $contribs,
            "username" => $username,
        ];
        $this->display('joueur/lastCadavre.html.twig',$data);
    }
}