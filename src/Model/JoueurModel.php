<?php

namespace App\Model;
use App\Entity\Joueur;
use App\Entity\Cadavre;
use App\Entity\Contribution;
use App\Entity\ContributionAleatoire;
use App\Model\CadavreModel;
use DateTime;

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

    public static function getUser(int $id_joueur)
    {
        $userInfo = Joueur::getInstance()->findBy(['id_joueur' => $id_joueur]);
        return $userInfo;
    }

    public static function getlatest(int $user_id): ?array
    {
        $latestContrib = Contribution::getInstance()->getUserLatest($user_id);
        $latestCadavre = null;
        if($latestContrib)
        {
            $latestCadavre = Cadavre::getInstance()->findBy(['id_cadavre' => $latestContrib['id_cadavre']])[0];
        }
        
        return $latestCadavre;

    }

    public static function getContribs($id_cadavre): array
    {
        $contribs = Contribution::getInstance()->findBy(['id_cadavre' => $id_cadavre]);
        $datas = [];
        $i = 0;
        foreach ($contribs as $contrib) {
            $i = $i+1;
            if ($contrib['id_joueur']) {
                $joueur = Joueur::getInstance()->findBy(['id_joueur' => $contrib['id_joueur']]);
                $joueur = $joueur[0]['nom_plume'];
            }else{
                $joueur = "";
            }
            $datas[$i] = [
                'contributions' => $contrib['texte_contribution'],
                'joueurs' => $joueur
            ];
        }
        return $datas;
    }

}