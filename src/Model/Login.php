<?php

namespace App\Model;
use App\Entity\Joueur;
use App\Entity\Admin;
use App\Helper\HTTP;

class Login extends Model
{

    public function returnAll(): array {
        $joueurEntity = Joueur::getInstance();
        return $joueurEntity->findAll();
    }


    public function authAdmin(string $email, string $password)
    {
        $admin = Admin::getInstance()->findBy(['ad_mail_administrateur' => $email]);

        if ($admin && $password === $admin[0]['mot_de_passe_administrateur']) {
            $_SESSION['loaded'] = true;
            $_SESSION['login'] = $admin[0]['ad_mail_administrateur'];

            return $admin;    
        }
    }


    public function authJoueur(string $username, string $password)
    {
        $joueur = Joueur::getInstance()->findBy(['nom_plume' => $username]);

        if($joueur && $password === $joueur[0]['mot_de_passe_joueur']) {
            $_SESSION['loaded'] = true;
            $_SESSION['login'] = $joueur[0]['nom_plume'];

            return $joueur;
        }
    }

    public function logout()
    {
        
        session_destroy();
    }
    
}