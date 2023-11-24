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
class Contribution
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

    /**
     * @param  integer  $id identifiant
     * @return array
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE id = :id";
        $sth = $this->query($sql, [':id' => $id]);
        if ($sth && $sth->rowCount()) {
            return $sth->fetch();
        }

        return null;
    }

    /**
     * Retourne toutes les informations.
     *
     * @return array
     */
    public function findAll(): ?array
    {
        $sql = "SELECT * FROM `{$this->tableName}`";
        $sth = $this->query($sql);
        if ($sth) {
            return $sth->fetchAll();
        }

        return [];
    }

    /**
     * Retourne les informations associées à un/des critères.
     *
     * @param  array  $criterias le tableau des critères
     * @return array
     */
    public function findBy(array $criterias): ?array
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

    /**
     * Indique si l'identifiant existe déjà dans la base.
     *
     * @param  integer  $id identifiant à tester.
     * @return bool
     */
    public function exists(int $id): bool
    {
        $sql = "SELECT COUNT(*) AS c FROM `{$this->tableName}` WHERE id = :id";
        $sth = $this->query($sql, [':id' => $id]);
        if ($sth) {
            return ($sth->fetch()['c'] > 0);
        }

        return false;
    }

    /**
     * Ajoute les nouvelles informations.
     *
     * @param  array  $datas  données à ajouter organisées sous forme de tableau associatif.
     * @return integer
     */
    public function create(array $datas): ?int
    {
        $sql = 'INSERT INTO `' . $this->tableName . '` ( ';
        foreach (array_keys($datas) as $k) {
            $sql .= " {$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1) . ' ) VALUE (';
        foreach (array_keys($datas) as $k) {
            $sql .= " :{$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1) . ' )';

        foreach (array_keys($datas) as $k) {
            $attributes[':' . $k] = $datas[$k];
        }
        $sth = $this->query($sql, $attributes);
        if ($sth) {
            return self::$dbh->lastInsertId();
        }

        return null;
    }

    /**
     * Édite les  informations d'un identifiant.
     *
     * @param  integer  $id     identifiant à modifier.
     * @param  array  $datas  tableau associatif des données à modifier.
     * @return bool
     */
    public function update(int $id, array $datas): bool
    {
        $sql = 'UPDATE `' . $this->tableName . '` SET ';
        foreach (array_keys($datas) as $k) {
            $sql .= " {$k} = :{$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' WHERE id =:id';

        foreach (array_keys($datas) as $k) {
            $attributes[':' . $k] = $datas[$k];
        }
        $attributes[':id'] = $id;
        $sth = $this->query($sql, $attributes);

        return $sth->rowCount() > 0;
    }



    /**
     * Efface l'identifiant.
     *
     * @param  integer  $id identifiant
     * @return int|boolean
     */
    public function delete(int $id): int
    {
        $sql = "DELETE FROM `{$this->tableName}` WHERE id = :id";
        $sth = $this->query($sql, [':id' => $id]);

        return $sth->rowCount() > 0;
    }

    /**
     * Excécute une requète.
     *
     * @param string $sql           expression SQL à traiter
     * @param array $attributs      tableau des attributs
     * @return void
     */
    public function query(string $sql, array $attributs = null)
    {
        // si des attributs sont spécifiés ...
        if ($attributs !== null) {
            // Requête préparée
            $sth = self::$dbh->prepare($sql);
            $sth->execute($attributs);

            return $sth;
        } else {
            // ... sinon faire une requête simple
            return self::$dbh->query($sql);
        }
    }
  
    public function getUserLatest(int $id_joueur): ?array
    {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE id_joueur = :id ORDER BY date_soumission DESC";
        $sth = $this->query($sql, [':id' => $id_joueur]);
        if ($sth && $sth->rowCount()) {
            return $sth->fetch();
        }

        return null;
    }
}
