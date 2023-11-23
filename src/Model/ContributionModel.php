<?php

namespace App\Model;

use App\Helper\HTTP;

use App\Entity\Cadavre;
use App\Entity\Contribution;
use App\Entity\ContributionAleatoire;

use App\Model\CadavreModel;

use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ContributionModel
{

    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new (get_called_class())();
        }

        return self::$instance;
    }

    public static function getRandom(int $id_joueur)
    {
        $random = null;
        $activeCadavre = CadavreModel::getInstance()->cadavreEnCours();
        $contribAleaModel = ContributionAleatoire::getInstance();
        $contribAleatoire = $contribAleaModel->findBy(
            [
                'id_joueur' => $id_joueur,
                'id_cadavre' => $activeCadavre['id_cadavre'],
            ])[0];
        if($contribAleatoire){
            $random = Contribution::getInstance()->findBy(['id_contribution'=>$contribAleatoire['num_contribution']])[0];
        }
        return $random;
    }

    public static function setRandom(int $id_joueur)
    {
        $activeCadavre = CadavreModel::getInstance()->cadavreEnCours();
        $cadavreCountContrib = count(Contribution::getInstance()->findBy(['id_cadavre' => $activeCadavre['id_cadavre']]));
        $random = random_int(1, $cadavreCountContrib);
        $randomContrib = Contribution::getInstance()->findBy(['ordre_soumission' => $random])[0];
        $contribAleatoire = ContributionAleatoire::getInstance()->create(
            [ 
                'id_joueur' => $id_joueur,
                'id_cadavre' => $randomContrib['id_cadavre'],
                'num_contribution' => $randomContrib['id_contribution']
            ]); 

        return $contribAleatoire;
    }

    public static function countContrib(int $id_cadavre)
    {
        $activeCadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id_cadavre])[0];
        $cadavreCountContrib = count(Contribution::getInstance()->findBy(['id_cadavre' => $activeCadavre['id_cadavre']]));
        return $cadavreCountContrib;
    }

    public static function newContrib($user_id, $cadavre, $text, $ordre){
        
        $textContrib = $text;
        $id_cadavre = $cadavre['id_cadavre'];
        $now = date('Y-m-d');
        Contribution::getInstance()->create(
            [
                'texte_contribution' => $textContrib,
                'date_soumission' => $now,
                'ordre_soumission' => $ordre,
                'id_joueur' => $user_id,
                'id_administrateur' => null,
                'id_cadavre' => $id_cadavre
            ]);
        if($ordre+1 >= $cadavre['nb_contributions']){
            Cadavre::getInstance()->update($id_cadavre,['date_fin_cadavre'=>$now]);
        }
    }

    public static function getUserContrib(int $user_id)
    {
        $activeCadavre = CadavreModel::getInstance()->cadavreEnCours();
        $id_cadavre = $activeCadavre['id_cadavre'];
        $userContrib = Contribution::getInstance()->findBy(['id_joueur'=>$user_id,'id_cadavre'=>$id_cadavre]);
        return $userContrib;
    }
}