<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\ContributionModel;
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

        $contributionModel = ContributionModel::getInstance();

        $activeCadavre = $contributionModel->getActiveCadavre();

        $random = $contributionModel->getRandom($_SESSION['user_id']);
        $randContrib = $random['texte_contribution'];

        $title = $activeCadavre['titre_cadavre'];
        $maxContrib = $activeCadavre['nb_contributions'];
        $totalContrib = $contributionModel->countContrib($activeCadavre['id_cadavre']);

        $canAddContrib = true;
        $msg = "";
        $userContribText = "";

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $totalContrib = $contributionModel->countContrib($activeCadavre['id_cadavre']);

            if($totalContrib >= $maxContrib)
            {

                $msg="Impossible d'ajouer une nouvelle contribution, le maximum pour ce Cadavre Exquis à déjà été atteint!";

            } else {

            $contributionModel->newContrib($_SESSION['user_id'], $activeCadavre, $totalContrib);

            }
            
        }

        if($totalContrib >= $maxContrib)
            {

                $msg="Impossible d'ajouer une nouvelle contribution, le maximum pour ce Cadavre Exquis à déjà été atteint!";
                $canAddContrib = false;

            }

        $userContrib = $contributionModel->getUserContrib($_SESSION['user_id']);

        if($userContrib)
        {
            $canAddContrib = false;
            $userContribText = $userContrib[0]['texte_contribution'];
            $msg = 'Vous ne pouvez pas participer une deuxième fois à ce Cadavre Exquis';
        }
    

        var_dump($maxContrib);
        var_dump($totalContrib);



        $data= [
            "title" => $title,
            "randContrib" => $randContrib,
            "canAddContrib" => $canAddContrib,
            "msg" => $msg,
            "userContribText" => $userContribText,
        ];
        $this->display('joueur/contribution.html.twig',$data);
    }
}