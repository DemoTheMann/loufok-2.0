<?php

namespace App\Model;
use App\Entity\Joueur;
use App\Entity\Cadavre;
use App\Entity\Contribution;
use App\Entity\ContributionAleatoire;
use App\Model\CadavreModel;
use DateTime;

class JoueurModel extends Model
{
    public static function getRandom(int $id_joueur)
    {
        $activeCadavre = CadavreModel::getInstance()->getActiveCadavre();
        $contribAleaModel = ContributionAleatoire::getInstance();
        $contribAleatoire = $contribAleaModel->findBy(
            [
                'id_joueur' => $id_joueur,
                'id_cadavre' => $activeCadavre['id_cadavre'],
            ]);
        return $contribAleatoire;
    }

    public static function getUser(int $id_joueur)
    {
        $userInfo = Joueur::getInstance()->findBy(['id_joueur' => $id_joueur]);
        return $userInfo;
    }

    public static function setRandom(int $id_joueur)
    {
        $activeCadavre = CadavreModel::getInstance()->getActiveCadavre();
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
        return [];
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