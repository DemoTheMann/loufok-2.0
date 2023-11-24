---
    sidebar_position: 7
---

# verificationPeriode()

La méthode verificationPerdiode() de la classe CadavreModel prend en paramètre la date de début et de fin d'un nouveau cadavre et vérifie si elle ne chevauche pas sur la période d'un Cadavre Exquis déjà existant.

Si le test ne trouve pas de chevauchement, la méthode ne renvoie rien.
Si un chevauchement est identifié, alors la méthode renvera un string en tant que message d'erreur.

Cette méthode fait appel à l'entitée :
- `Cadavre`

## Code

```php title="CadavreModel"
/**
    * Ne renvoie rien si aucune période ne se chevauche, renvoie un string de l'erreur si chevauchement
    */
    public static function verificationPeriode($debut, $fin){
        $debut_cadavre = $debut;
        $fin_cadavre = $fin;
        $errors = 0;
        $cadavres_existants = Cadavre::getInstance()->findAll();
        foreach ($cadavres_existants as $cadavre => $c) {
            if ($debut_cadavre>=$c['date_debut_cadavre'] && $debut_cadavre<=$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
            
            if ($fin_cadavre>=$c['date_debut_cadavre'] && $fin_cadavre<=$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
            
            if ($debut_cadavre<=$c['date_debut_cadavre'] && $fin_cadavre>=$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
        }
        if($errors){
            return $errors;
        }
    }
```