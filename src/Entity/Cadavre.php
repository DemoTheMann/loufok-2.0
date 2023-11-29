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

    public function findAllEnded(): ?array
    {
        $now = date('Y-m-d');
        $sql = "SELECT * FROM `{$this->tableName}` wHERE date_fin_cadavre < $now";
        $sth = $this->query($sql);
        if ($sth) {
            return $sth->fetchAll();
        }

        return [];
    }

}