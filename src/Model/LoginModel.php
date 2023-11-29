<?php

namespace App\Model;
use App\Entity\Joueur;
use App\Entity\Admin;
use App\Helper\HTTP;

class LoginModel
{

    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new (get_called_class())();
        }

        return self::$instance;
    }

    public function authAdmin(string $email, string $password): void
    {
        $admin = Admin::getInstance()->findBy(['ad_mail_administrateur' => $email]);

        if ($admin && $password === $admin[0]['mot_de_passe_administrateur']) {
            $_SESSION['auth'] = true;
            $_SESSION['role'] = 'administrateur';
            $_SESSION['user_id'] = $admin[0]['id_administrateur'];
        }
    }


    public function authJoueur(string $username, string $password): void
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