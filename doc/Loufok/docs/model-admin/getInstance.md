---
    sidebar_position: 1
---

# getInstance()

La méthode getInstance() de la classe AdminModel ne prend pas de paramètres et renvoie l'instance de la classe statique AdminModel.

## Code

```php title="AdminModel.php"
protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new (get_called_class())();
        }

        return self::$instance;
    }
```