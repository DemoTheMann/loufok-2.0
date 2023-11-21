<?php

namespace App\Model;
use App\Entity\Cadavre;
use App\Entity\Contribution;
use App\Entity\ContributionAleatoire;
use DateTime;
use App\Model\CadavreModel;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ContributionModel extends Model
{

    public static function getRandom(int $id_joueur)
    {
        $activeCadavre = CadavreModel::getInstance()->getActiveCadavre();
        $contribAleaModel = ContributionAleatoire::getInstance();
        $contribAleatoire = $contribAleaModel->findBy(
            [
                'id_joueur' => $id_joueur,
                'id_cadavre' => $activeCadavre['id_cadavre'],
            ])[0];
        $random = Contribution::getInstance()->findBy(['id_contribution'=>$contribAleatoire['num_contribution']]);
        return $random[0];
    }

    
    public static function getActiveCadavre(): ?array
    {
        $now = time();
        $cadavres = Cadavre::getInstance()->findAll();
        foreach($cadavres as $cadavre => $c)
        {
            $date_debut = strtotime($c['date_debut_cadavre']);
            $date_fin = strtotime($c['date_fin_cadavre']);
            
            if($date_debut < $now && $date_fin > $now)
            {
                return $c;
            }
        }
    }

    public static function countContrib(int $id_cadavre)
    {
        $activeCadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id_cadavre])[0];
        $cadavreCountContrib = count(Contribution::getInstance()->findBy(['id_cadavre' => $activeCadavre['id_cadavre']]));
        return $cadavreCountContrib;
    }
}