---
    sidebar_position: 3
---

# titres()

La méthode titres() de la classe CadavreModel ne prend pas de paramètres et renvoit un array des titres des cdavres existants.

## Code

```php title="CadavreModel"
    /**
     * Renvoie les titres de tous les cadavre exquis
     */
    public static function titres(){
        $cadavres = Cadavre::getInstance()->findAll();
        $titres = [];
        foreach ($cadavres as $cadavre) {
            array_push($titres, $cadavre['titre_cadavre']);
        }
        return $titres;
    }
```