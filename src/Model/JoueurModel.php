<?php

namespace App\Model;
use App\Entity\Joueur;
use App\Entity\Cadavre;
use App\Entity\Contribution;

class JoueurModel
{

    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new (get_called_class())();
        }

        return self::$instance;
    }
    
    public function canPlay(string $name)
    {
        $ajd = date('Y-m-d');
        switch ($name) {
            case "tom":
            case "ecrivain":
            case "mylan":
            case "":
                $date = "2023-12-07";
                break;
            case "artiste":
            case "":
            case "":
            case "":
                $date = "2023-12-09";
                break;
            case "":
            case "":
            case "":
            case "":
                $date = "2023-12-11";
                break;
            case "":
            case "":
            case "":
            case "":
                $date = "2023-12-13";
                break;
            case "pascalito":
                $date = "2023-12-15";
                break;
            default:
                break;
        }
        if($date <= $ajd)
        {
            return $ajd;
        }else{
            return $date;
        }
    }

    public static function getUserName(int $id_joueur)
    {
        $userInfo = Joueur::getInstance()->findBy(['id_joueur' => $id_joueur]);
        return $userInfo[0]['nom_plume'];
    }

    public static function getLatest(int $user_id): ?array
    {
        $latestContrib = Contribution::getInstance()->getUserLatest($user_id);
        $latestCadavre = null;
        if($latestContrib){
            foreach ($latestContrib as $contrib) {
                $isCadavreOn = CadavreModel::getInstance()->isCadavreOn($contrib['id_cadavre']);
                if(!$isCadavreOn){
                    return $latestCadavre = Cadavre::getInstance()->findBy(['id_cadavre' => $contrib['id_cadavre']])[0];
                }
            }
        }else{
            return null;
        }
        

    }

}