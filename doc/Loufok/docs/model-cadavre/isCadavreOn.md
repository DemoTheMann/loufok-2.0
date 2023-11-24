---
    sidebar_position: 5
---

# isCadavreOn()

La méthode isCadavreOn() de la classe CadavreModel prend en paramètre l'identifiant d'un cadavre et vérifie si il est toujours actif.
Il renvoie les informations du cadavre si positif ou null si négatif.

Cette méthode fait appel aux entitées :
- `Cadavre`
- `Contribution`

## Code

```php title="CadavreModel"
public static function isCadavreOn(int $id_cadavre)
    {
        $ajd = date('Y-m-d');
        $cadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id_cadavre])[0];

            //si un cadavre exquis est en cours aujourd'hui
            if($cadavre['date_debut_cadavre']<= $ajd && $cadavre['date_fin_cadavre']>=$ajd){
            
                //récupérer les contributions du cadavre en cours pour vérif si le max n'a pas été atteint
                $contributions = Contribution::getInstance()->findBy(['id_'.$_SESSION['role'] => $_SESSION['user_id'], 'id_cadavre'=> $cadavre['id_cadavre']]);
                $max_contribution = 0;
                foreach ($contributions as $contribution) {
                    $max_contribution = $max_contribution + 1; 
                }

                //si le max de contributions a été atteint : renvoie null
                if ($max_contribution >=$cadavre['nb_contributions']) {
                    return null;
                }else{
                    //si le max de contributions n'a pas été atteint : affichage du cadavre en cours
                    return $cadavre;
                }
        }

        return null;
    }
```