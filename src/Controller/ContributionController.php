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

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {

        }

        $contributionModel = ContributionModel::getInstance();

        $activeCadavre = $contributionModel->getActiveCadavre();

        $random = $contributionModel->getRandom($_SESSION['user_id']);

        $title = $activeCadavre['titre_cadavre'];
        $maxContrib = $activeCadavre['nb_contributions'];
        $totalContrib = $contributionModel->countContrib($activeCadavre['id_cadavre']);

        var_dump($maxContrib);
        var_dump($totalContrib);
        var_dump($random);

        $randContrib = $random['texte_contribution'];
        $canAddContrib = true;


        $data= [
            "title" => $title,
            "randContrib" => $randContrib,
            "canAddContrib" => $canAddContrib,
        ];
        $this->display('joueur/contribution.html.twig',$data);
    }
}