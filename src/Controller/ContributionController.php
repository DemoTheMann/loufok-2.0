<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Model\ContributionModel;
use App\Model\CadavreModel;

use App\Helper\HTTP;
use DateTime;

class ContributionController extends Controller
{
    public function contribution()
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

        $contribModel = ContributionModel::getInstance();
        $cadavreModel = CadavreModel::getInstance();

        $title = "";
        $randContrib = "";
        $canAddContrib = true;
        $msg = "";
        $userContribText = "";
        $error = "";

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $activeCadavre = $cadavreModel->cadavreEnCours();
            if($activeCadavre)
            {
            
            $totalContrib = $contribModel->countContrib($activeCadavre['id_cadavre']);
            $maxContrib = $activeCadavre['nb_contributions'];

                if($totalContrib >= $maxContrib)
                {
                    $msg="Impossible d'ajouer une nouvelle contribution, le maximum pour ce Cadavre Exquis à déjà été atteint!";
                } else {
                    $contribModel->newContrib($_SESSION['user_id'], $activeCadavre, $_POST['contribution'], $totalContrib+1);
                }
            } else {
                $error = "Impossible d'ajouter votre contribution car le Cadavre Exquis à été cloturé avant.";

                $data= [
                    "title" => $title,
                    "randContrib" => $randContrib,
                    "canAddContrib" => $canAddContrib,
                    "msg" => $msg,
                    "userContribText" => $userContribText,
                    "error" => $error,
                ];
                $this->display('joueur/contribution.html.twig',$data);
            }
        }

            $activeCadavre = $cadavreModel->cadavreEnCours();

            $random = $contribModel->getRandom($_SESSION['user_id']);
            $randContrib = $random['texte_contribution'];

            $title = $activeCadavre['titre_cadavre'];
            $maxContrib = $activeCadavre['nb_contributions'];
            $totalContrib = $contribModel->countContrib($activeCadavre['id_cadavre']);

            if($totalContrib >= $maxContrib)
                {

                    $msg="Impossible d'ajouer une nouvelle contribution, le maximum pour ce Cadavre Exquis à déjà été atteint!";
                    $canAddContrib = false;

                }

            $userContrib = $contribModel->getUserContrib($_SESSION['user_id']);

            if($userContrib)
            {
                $canAddContrib = false;
                $userContribText = $userContrib[0]['texte_contribution'];
                $msg = 'Vous ne pouvez pas participer une deuxième fois à ce Cadavre Exquis';
            }

            $data= [
                "title" => $title,
                "randContrib" => $randContrib,
                "canAddContrib" => $canAddContrib,
                "msg" => $msg,
                "userContribText" => $userContribText,
                "error" => $error,
            ];
            $this->display('joueur/contribution.html.twig',$data);
        
    }
}