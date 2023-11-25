<?php

namespace App\Entity;

class ContributionAleatoire extends Base
{
    protected $tableName = APP_TABLE_PREFIX . 'contribution_aléatoire';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


}