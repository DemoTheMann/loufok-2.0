---
    sidebar_position: 6
---

# dateProchainCadavre()

La méthode DateProchainCadavre() de la classe CadavreModel ne prend pas de paramètres et renvoie la date de début du prochain cadavre.

Cette méthode fait appel aux entitées :
- `Cadavre`

## Code

```php title="CadavreModel"
/**
     * Récupère la date du prochain cadavre exquis. La méthode ne vérifie pas si 
     * un cadavre exquis est en cours, la vérification est à faire au préalable.
     */
    public static function dateProchainCadavre()
    {
        $cadavres = Cadavre::getInstance()->findAll();
        //Si le prochain cadavre exquis commence dans + d'1 an, date de référence
        $future_date = date('Y-m-d', strtotime('+1 year'));
        $min_date = $future_date;
        //récupérer les dates de chaque cadavre
        foreach ($cadavres as $cadavre => $c) {   
            //si la date de début est plus récente que la date de réf, on attribue sa valeur à min_date
            if($c['date_debut_cadavre']< $min_date){
                $min_date = $c['date_debut_cadavre'];
            }
        }
        //si la valeur de réf est tjrs là, alors le prochain cadavre exquis commence au minima
        //dans plus d'un an OU s'il n'y a pas de cadavre exquis prévu pour le moment.
        if($min_date===$future_date){
            $min_date = "Plus d'un an";
            return $min_date;
        }
        $date = date("d/m/Y", strtotime($min_date));
        return $date;
    }
```