<?php

namespace App\Model;
use App\Entity\Joueur;
use App\Entity\Admin;
use App\Helper\HTTP;

class LoginModel extends Model
{

    public function returnAll(): array {
        $joueurEntity = Joueur::getInstance();
        return $joueurEntity->findAll();
    }


    public function authAdmin(string $email, string $password):void
    {
        $admin = Admin::getInstance()->findBy(['ad_mail_administrateur' => $email]);

        if ($admin && $password === $admin[0]['mot_de_passe_administrateur']) {
            $_SESSION['auth'] = true;
            $_SESSION['role'] = 'admin';
            $_SESSION['user'] = $admin[0];
        }
    }


    public function authJoueur(string $username, string $password):void
    {
        $joueur = Joueur::getInstance()->findBy(['nom_plume' => $username]);

        if($joueur && $password === $joueur[0]['mot_de_passe_joueur']) {
            $_SESSION['auth'] = true;
            $_SESSION['role'] = 'joueur';
            $_SESSION['user_id'] = $joueur[0]['id_joueur'];
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }
    
}