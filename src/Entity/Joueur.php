<?php

namespace App\Entity;

class Joueur extends Base
{
    protected $tableName = APP_TABLE_PREFIX . 'joueur';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


}