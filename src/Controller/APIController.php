<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Entity\Cadavre;
use App\Entity\Admin;
use App\Model\ContributionModel;
use Symfony\Component\Validator\ConstraintViolation;

class APIController extends Controller
{

    public function getCadavres()
    {
        $data = [];    
        $cadavres = Cadavre::getInstance()->findAll();

        foreach($cadavres as $cadavre)
        {
            $now = date('Y-m-d');
            if($cadavre['date_fin_cadavre'] < $now)
            {
                $contribution = ContributionModel::getInstance()->getContribs($cadavre['id_cadavre']);

                $cadavre['contribution'] = $contribution[1]['contributions'];
                array_push($data, $cadavre);
            }

        }

        if(!$data)
        {
            http_response_code(200);
            $data = 'Aucun cadavre fini trouvé';
        }

        // retour au format JSON
        header('Content-Type: application/json');
        // indique au client qu'il est habilité à faire des demandes
        header('Access-Control-Allow-Origin: *', true);
        // indique au client les méthodes reconnues
        header('Access-Control-Allow-Headers: accept,content-type');
        header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
        // limiter le nombre de requêtes préliminaires en demandant
        // au navigateur à mettre en cache la requête pendant 1000 secondes
        header('Access-Control-Max-Age: 1000');
        echo json_encode($data);
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
            $adr_admin = Admin::getInstance()->findBy(['id_administrateur'=>$cadavre['id_administrateur']])[0];
            $cadavre['adr_admin'] = $adr_admin['ad_mail_administrateur'];
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

            sort($cadavre['joueurs']);

            $cadavre = (object) $cadavre;

            $data = $cadavre;

        } else {
            http_response_code(404);
            $data = 'Aucun cadavre trouvé avec cet identifiant';
        }

        // retour au format JSON
        header('Content-Type: application/json');
        // indique au client qu'il est habilité à faire des demandes
        header('Access-Control-Allow-Origin: *', true);
        // indique au client les méthodes reconnues
        header('Access-Control-Allow-Headers: accept,content-type');
        header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
        // limiter le nombre de requêtes préliminaires en demandant
        // au navigateur à mettre en cache la requête pendant 1000 secondes
        header('Access-Control-Max-Age: 1000');
        echo json_encode($data);
        exit;
    }

    public function likeCadavre()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {    
            $QBody = json_decode(file_get_contents("php://input"), true);

            if(isset($QBody['idCadavre']))
            {
                $id = $QBody['idCadavre'];

                $cadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id])[0];
                $nb_jaime = $cadavre['nb_jaime'];
                $nb_jaime ++;
                $response = Cadavre::getInstance()->update($id,['nb_jaime'=>$nb_jaime]);

            } else {
                http_response_code(203);
                $response = [
                    'status' => '203',
                    'error' => 'Incorrect body'
                ];
            }

            header('Access-Control-Allow-Origin: *', true);
            return $response;
            exit;

        }
    }

    public function dislikeCadavre()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {    
            $QBody = json_decode(file_get_contents("php://input"), true);

            if(isset($QBody['idCadavre']))
            {
                $id = $QBody['idCadavre'];

                $cadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id])[0];
                $nb_jaime = $cadavre['nb_jaime'];
                if(!$nb_jaime === 0){
                    $nb_jaime --;
                    $response = Cadavre::getInstance()->update($id,['nb_jaime'=>$nb_jaime]);
                }
            } else {
                http_response_code(203);
                $response = [
                    'status' => '203',
                    'error' => 'Incorrect body'
                ];
            }

            header('Access-Control-Allow-Origin: *', true);
            return $response;
            exit;

        }
    }


}