<?php

namespace App\Model;
use App\Entity\Joueur;

class Login extends Model
{

    public function returnAll(): array {
        $joueurEntity = Joueur::getInstance();
        return $joueurEntity->findAll();
    }
}