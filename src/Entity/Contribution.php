<?php

//
// Fichier: src\Model\Model.php
//
namespace App\Entity;

/**
 * Classe CRUD modèle qui contient les 7 méthodes :
 *   - findAll()                        pour rechercher toutes les données
 *   - find( int $id )                  pour rechercher un identifiant
 *   - findBy( array $criterias )       pour rechercher en fonction d'un/ou plusieurs critères
 *   - create( array $datas )           pour ajouter une donnée
 *   - update( int $id, array $datas )  pour mettre à jour une donnée
 *   - delete( int $id )                pour effacer une donnée
 *   - exist( int $id )                 pour vérifier si une donnée existe
 */
class Contribution extends Base
{
    protected $tableName = APP_TABLE_PREFIX . 'contribution';
    // instance de la classe
  
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getUserLatest(int $id_joueur): ?array
    {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE id_joueur = :id ORDER BY date_soumission DESC LIMIT 2";
        $sth = $this->query($sql, [':id' => $id_joueur]);
        if ($sth && $sth->rowCount()) {
            return $sth->fetchAll();
        }

        return null;
    }

    public function findByOrderedContribs(array $criterias): ?array
    {
        // décomposer le tableau des critères
        foreach ($criterias as $f => $v) {
            $fields[] = "$f = ?";
            $values[] = $v;
        }
        // On transforme le tableau en chaîne de caractères séparée par des AND
        $fields_list = implode(' AND ', $fields);
        $sql = "SELECT * FROM `{$this->tableName}` WHERE $fields_list ORDER BY ordre_soumission ASC";

        return $this->query($sql, $values)->fetchAll();
    }
}
