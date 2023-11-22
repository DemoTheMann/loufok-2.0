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
        $title = $activeCadavre['titre_cadavre'];


        $data= [
            "title" => $title
        ];
        $this->display('joueur/contribution.html.twig',$data);
    }
}