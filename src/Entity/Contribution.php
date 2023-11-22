<?php

namespace App\Entity;

class Contribution extends Base
{
    protected $tableName = APP_TABLE_PREFIX . 'contribution';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getUserLatest(int $id_joueur): ?int
    {
        
    }

}