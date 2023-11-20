<?php

namespace App\Model;
use App\Entity\Cadavre;
use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ContributionModel extends Model
{



    
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
}