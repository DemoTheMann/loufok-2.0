<?php

namespace App\Entity;

class Cadavre extends Base
{
    protected $tableName = APP_TABLE_PREFIX . 'cadavre';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}