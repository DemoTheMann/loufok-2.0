---
    sidebar_position: 4
---

# cadavreEnCours()

La méthode cadavreEnCours() de la classe CadavreModel ne prend pas de paramètres et effectue des vérifications de périodes et de contributions max pour renvoyer les informations du Cadavre Exquis en cours ou alors rien si il n'y en à pas.

Cette méthode fait appel aux entitées :
- `Cadavre`
- `Contribution`

## Code

```php title="CadavreModel"
    /**
     * Renvoie le cadavre exquis en cours ou rien
     */
public static function cadavreEnCours()
    {
        //renvoie le cadavre (array) en cours
        $ajd = date('Y-m-d');
        $cadavres = Cadavre::getInstance()->findAll();
        foreach ($cadavres as $cadavre => $c) {

            //si un cadavre exquis est en cours aujourd'hui
            if($c['date_debut_cadavre']<= $ajd && $c['date_fin_cadavre']>=$ajd){
            
                //récupérer les contributions du cadavre en cours pour vérif si le max n'a pas été atteint
                $contributions = Contribution::getInstance()->findBy(['id_'.$_SESSION['role'] => $_SESSION['user_id'], 'id_cadavre'=> $c['id_cadavre']]);
                $max_contribution = 0;
                foreach ($contributions as $contribution) {
                    $max_contribution = $max_contribution + 1; 
                }

                //si le max de contributions a été atteint : renvoie null
                if ($max_contribution >=$c['nb_contributions']) {
                    return null;
                }else{
                    //si le max de contributions n'a pas été atteint : affichage du cadavre en cours
                    return $c;
                }
            }
        }
```