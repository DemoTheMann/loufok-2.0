<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Model\ContributionModel;
use App\Model\CadavreModel;
use App\Model\JoueurModel;

use App\Helper\HTTP;
use DateTime;

class ContributionController extends Controller
{
    public function contribution()
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

        $contribModel = ContributionModel::getInstance();
        $joueurModel = JoueurModel::getInstance();
        $cadavreModel = CadavreModel::getInstance();
        $user = JoueurModel::getInstance()->getUserName($_SESSION['user_id']);
        $title = "";
        $randContrib = "";
        $canAddContrib = true;
        $msg = "";
        $userContribText = "";
        $error = "";
        $activeCadavre = $cadavreModel->cadavreEnCours();
        //$joueurDates = $joueurModel->canPlayId($_SESSION['user_id']);
        $joueurDates = $joueurModel->canPlay($user);

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $activeCadavre = $cadavreModel->cadavreEnCours();
            
            if($activeCadavre){
                
                $totalContrib = $contribModel->countContrib($activeCadavre['id_cadavre']);
                $maxContrib = $activeCadavre['nb_contributions'];
                
                if($totalContrib >= $maxContrib)
                {
                    $msg="Impossible d'ajouter une nouvelle contribution, le maximum pour ce Cadavre Exquis à déjà été atteint!";
                } else {
                    $contribModel->newContrib($_SESSION['user_id'], $activeCadavre, $_POST['contribution'], $totalContrib+1);
                }
            }else{
                $error = "Impossible d'ajouter votre contribution car le Cadavre Exquis à été cloturé avant.";
                $data= [
                    "title" => $title,
                    "randContrib" => $randContrib,
                    "canAddContrib" => $canAddContrib,
                    "msg" => $msg,
                    "userContribText" => $userContribText,
                    "error" => $error,
                    "username" => $user,
                    "contributions" => 0,
                    "joueur" => $joueurDates,
                ];
            }}
                if(!$activeCadavre || $error || $msg){
                    $this->display('joueur/contribution.html.twig',$data);
                }
            $activeCadavre = $cadavreModel->cadavreEnCours();
            if($activeCadavre){
                $random = $contribModel->getRandom($_SESSION['user_id']);
                if(!$random){
                    $random = $contribModel->setRandom($_SESSION['user_id']);
                }
                $randContrib = $random;
                $title = $activeCadavre['titre_cadavre'];
                $maxContrib = $activeCadavre['nb_contributions'];
                $totalContrib = $contribModel->countContrib($activeCadavre['id_cadavre']);
                
                if($totalContrib >= $maxContrib)
                {
                    
                    $msg="Impossible d'ajouer une nouvelle contribution, le maximum pour ce cadavre exquis à déjà été atteint!";
                    $canAddContrib = false;
                }
                
                $userContrib = $contribModel->getUserContrib($_SESSION['user_id']);
                
                if($userContrib)
                {
                    $canAddContrib = false;
                    $userContribText = $userContrib[0]['texte_contribution'];
                    $msg = 'Vous ne pouvez pas participer une deuxième fois à ce cadavre exquis';
                }
                $contributionsContent = ContributionModel::getInstance()->getContribs($activeCadavre['id_cadavre']);
                $i =0;
                $contributions = [];
                foreach ($contributionsContent as $c) {          
                    $i = $i + 1;
                    $contributions[$i] = $c['contributions'];
                }; 
            }  
            if(!$activeCadavre){
                $contributions = 0;
            }
            $data= [
                "title" => $title,
                "randContrib" => $randContrib,
                "canAddContrib" => $canAddContrib,
                "msg" => $msg,
                "userContribText" => $userContribText,
                "username" => $user,
                "error" => $error,
                "contributions" => $contributions,
                "joueur" => $joueurDates,
            ];

            $this->display('joueur/contribution.html.twig', $data);
        }
    }

