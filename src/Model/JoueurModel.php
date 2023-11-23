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

    public static function getUserName(int $id_joueur)
    {
        $userInfo = Joueur::getInstance()->findBy(['id_joueur' => $id_joueur]);
        return $userInfo[0]['nom_plume'];
    }

    public static function getlatest(int $user_id): ?array
    {
        $latestContrib = Contribution::getInstance()->getUserLatest($user_id);
        $latestCadavre = null;
        if($latestContrib)
        {
            $isCadavreOn = CadavreModel::getInstance()->isCadavreOn($latestContrib['id_cadavre']);
            if(!$isCadavreOn){
                return null;
            }

            $latestCadavre = Cadavre::getInstance()->findBy(['id_cadavre' => $latestContrib['id_cadavre']])[0];
        }
        
        return $latestCadavre;

    }

}