---
    sidebar_position: 2
---

# periodes()

La méthode periodes() de la classe CadavreModel ne prend pas de paramètres et renvoit un array des périodes déjà occupées par des cadavres existant.  

Cette méthode fait appel à l'entitée :
- `Cadavre`

## Code

```php title="CadavreModel"
public static function periodes(){
        $cadavres = Cadavre::getInstance()->findAll();
        $periodes = [];
        $result = [];
        $i = 0;
        foreach ($cadavres as $cadavre) {
            $i = $i + 1;
            $periodes[$i] = 
            [
                'debut_cadavre' => $cadavre['date_debut_cadavre'],
                'fin_cadavre' => $cadavre['date_fin_cadavre']
            ];
            array_push($result, $periodes[$i]);
        }
        return $periodes;
    }
```