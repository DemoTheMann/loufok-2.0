<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Entity\Cadavre;
use App\Model\ContributionModel;

class APIController extends Controller
{
    public function getCadavres()
    {
        $data = [];    
        $cadavres = Cadavre::getInstance()->findAll();

        foreach($cadavres as $cadavre)
        {
            $cadavre['contributions'] = [];
            $cadavre['joueurs'] = [];
            $contributions = ContributionModel::getInstance()->getContribs($cadavre['id_cadavre']);

            foreach($contributions as $contribution)
            {
                array_push($cadavre['contributions'], $contribution['contributions']);
                if($contribution['joueurs'])
                {
                    array_push($cadavre['joueurs'], $contribution['joueurs']);
                }
            }

            array_push($data, $cadavre);

        }

        $data = json_encode($data);

        header('Content-Type: application/json');
        echo $data;
        exit;
    }

    public function getCadavreById($id)
    {   
        $data = [];
        $id = intval($id);

        $cadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id]);

        if($cadavre){
            $cadavre = $cadavre[0];
            $contributions = ContributionModel::getInstance()->getContribs($cadavre['id_cadavre']);
            $cadavre['contributions'] = [];
            $cadavre['joueurs'] = [];

            foreach($contributions as $contribution)
                {
                    array_push($cadavre['contributions'], $contribution['contributions']);
                    if($contribution['joueurs'])
                    {
                        array_push($cadavre['joueurs'], $contribution['joueurs']);
                    }
                }
            array_push($data, $cadavre);
        }

        $data = json_encode($data);

        header('Content-Type: application/json');
        echo $data;
        exit;
    }

    public function likeCadavreById($id)
    {
        $id = intval($id);

        $cadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id])[0];
        $nb_jaime = $cadavre['nb_jaime'];
        $nb_jaime ++;
        Cadavre::getInstance()->update($id,['nb_jaime'=>$nb_jaime]);
    }
}