<?php

namespace App\Entity;

class Admin extends Base
{
    protected $tableName = APP_TABLE_PREFIX . 'administrateur';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


}