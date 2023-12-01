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
                $dates = [
                    "date_debut" => "2023-12-07",
                    "date_fin" => "2023-12-08"
                ];
                break;
            case "artiste":
            case "":
            case "":
            case "":
                $dates = [
                    "date_debut" => "2023-12-09",
                    "date_fin" => "2023-12-10"
                ];
                break;
            case "":
            case "":
            case "":
            case "":
                $dates = [
                    "date_debut" => "2023-12-11",
                    "date_fin" => "2023-12-12"
                ];
                break;
            case "":
            case "":
            case "":
            case "":
                $dates = [
                    "date_debut" => "2023-12-13",
                    "date_fin" => "2023-12-14"
                ];
                break;
            case "pascalito":
                $dates = [
                    "date_debut" => "2023-11-30",
                    "date_fin" => "2023-12-01"
                ];
                break;
            default:
                break;
        }

        return $dates;
    }

    public function canPlayId(int $id_joueur)
    {
        $ajd = date('Y-m-d');
        switch ($id_joueur) {
            case 1:
            case 2:
            case 3:
            //case 4:
                $dates = [
                    "date_debut" => "2023-12-07",
                    "date_fin" => "2023-12-08"
                ];
                break;
            case 5:
            case 6:
            case 7:
            case 8:
                $dates = [
                    "date_debut" => "2023-12-09",
                    "date_fin" => "2023-12-10"
                ];
                break;
            case 9:
            case 10:
            case 11:
            case 12:
                $dates = [
                    "date_debut" => "2023-12-11",
                    "date_fin" => "2023-12-12"
                ];
                break;
            case 13:
            case 14:
            case 15:
            case 16:
                $dates = [
                    "date_debut" => "2023-12-13",
                    "date_fin" => "2023-12-14"
                ];
                break;
            case 4:
                $dates = [
                    "date_debut" => "2023-11-30",
                    "date_fin" => "2023-12-01"
                ];
                break;
            default:
                break;
        }

        return $dates;
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