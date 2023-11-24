---
    sidebar_position: 1
---

# getInstance()

La méthode getInstance() de la classe JoueurModel ne prend pas de paramètres et renvoie l'instance de la classe statique JoueurModel.

## Code

```php title="ContributionModel.php"
protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new (get_called_class())();
        }

        return self::$instance;
    }
```