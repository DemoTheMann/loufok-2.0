---
    sidebar_position: 2
---

# Entitées Loufok

Les entitées sont responsable de la liaison entre la base de donnée MySQL et l'application.

## tableName

Chaque entitée comporte une variable qui contient le nom de la table avec la quelle elle comunique dans la base de donnée MySQL.
Si le nom de la table venait à changer, il suffit de changer le valeure de cette variable pour que l'application continue de fonctioner.

## Méthodes

Méthodes des entitées Loufok.

### __construct()

La méthode __construc() est appelé à l'instantiation de la classe, il va récupérer les informations de connexion à la base de donnée et tenter d'établir la liaison avec la table au nom spécifié dans `tableName`.

```php title="Entity"
public function __construct()
    {
        if (!self::$dbh) {
            try {
                $dsn = 'mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB_NAME . ';charset=UTF8';
                self::$dbh = new \PDO(
                    $dsn,
                    // nom de l'utilisateur MYSQL
                    APP_DB_USER,
                    // mot de passe de dl'utilisateur MYSQL
                    APP_DB_PASSWORD,
                    // réglage d'options qui permet de récupérer les informations de la base
                    // sous forme de tableau associatif
                    // et de demander de déclencher une exception quand une erreur de SQL est détectée
                    [
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    ]
                );
            } catch (\Exception $e) {
                // ICI on vient écrire le message qui doit s'afficher quand
                // une erreur de connexion à la base est produite
                // ou quand une erreur de syntaxe SQL est rencontrée

                // affichage d'un message résumé en couleur
                echo '<div style="font-size: 22px;color: red;padding: 2rem">';
                echo "<h1>ERREUR</h1><p>{$e->getMessage()}</p>";
                // si on ne veut pas donner trop de détail à l'internaute, alors on peut écrire
                // echo "<h1>ERREUR</h1></p>";
                echo '</div>';
                // arrêt du script
                die();
            }
        }
    }
```

### getInstance()

La méthode getInstance() ne prend pas de paramètres et renvoie l'instance de la classe statique de l'entitée en question.

```php title="Entity"
protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
```

### find()

La méthode find() prend en paramètre un identifiant et renvoit le tuple qui comporte cet identifiant dans sa table, si elle ne trouve rien, elle renvoit `null`.

```php title="Entity"
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
```

### findAll()

La méthode findAll() ne prend pas de paramètres et renvoit l'entièreté des tuples contenu dans sa table.

```php title="Entity"
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
```

### findBy()

La méthode FindBy() prend en paramètre un tableau associatif où la clé est un nom de champs et la valeur lié à cette clé la valeur attendu pour ce champs.

La méthode renvoit un tableau des tuples où ces critères ont été vérifiés.

```php title="Entity"
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
```

### exists()

La méthode exists() prend en paramètre un identifiant et renvoit `true` si cet identifiant existe dans la table, et `false` si il n'existe pas.

```php title="Entity"
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
```

### create()

La méthode create() est utilisée pour ajouter un tuple dans une table de la base de donnée, elle prend en paramètre un tableau associatif où les clés correspondent aux champs et les valeurs correspondent aux valeurs à inclure dans ces champs.

```php title="Entity"
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
```

### update()

La méthode update() est utilisée pour modifier un tuple dans la table, prend en paramètre un tableau associatif où les clés correspondent aux champs à modifier et les valeurs correspondent aux valeurs à inclure dans ces champs.

```php title="Entity"
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
```

### delete()

La méthode delete() prend un identifiant en paramètre et supprime de la table le tuple contenant cet identifiant.

```php title="Entity"
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
```

### query()

La méthode query() prend une requête SQL et des attributs si ils existent en paramètres et effectue en requête préparée cette opération.

Elle est utilisée dans les autres méthodes de la classe pour effectuer toutes les opérations vers la base de donnée MySQL.

```php title="Entity"
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
```

### getUserLatest()

La méthode getUserLatest() est seulement disponible dans l'entitée : `Contribution`, et prend un identifiant d'utilisateur en paramètre.

Elle est utilisée dans le `JoueurModel` afin de récupérer toutes les contributions ratachées à un utilisateur dans l'ordre des plus récentes aux plus anciennes.

```php title="Contribution.php"
public function getUserLatest(int $id_joueur): ?array
    {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE id_joueur = :id ORDER BY date_soumission DESC";
        $sth = $this->query($sql, [':id' => $id_joueur]);
        if ($sth && $sth->rowCount()) {
            return $sth->fetch();
        }

        return null;
    }
```