---
    sidebar_position: 5
---

# newContrib()

La méthode newContrib() de la classe ContributionModel prend en paramètre l'identifiant d'un utilisateur qui souhaite ajouter sa contribution à un cadavre, les informations du Cadavre Exquis en cours, le contenu textuel de la contribution à ajouter et l'ordre à attribué à la nouvelle contribution, calculé en ammont dans le controller.

Cette méthode ne renvoit rien, elle s'occupe seulement de l'insertion dans la base de données de la nouvelle contribution.

Cette méthode fait appel aux entitées :
- `Contribution`
- `Cadavre`


## Code

```php title="ContributionModel.php"
public static function newContrib($user_id, $cadavre, $text, $ordre){
        
        $textContrib = $text;
        $id_cadavre = $cadavre['id_cadavre'];
        $now = date('Y-m-d');
        Contribution::getInstance()->create(
            [
                'texte_contribution' => $textContrib,
                'date_soumission' => $now,
                'ordre_soumission' => $ordre,
                'id_joueur' => $user_id,
                'id_administrateur' => null,
                'id_cadavre' => $id_cadavre
            ]);
        if($ordre+1 >= $cadavre['nb_contributions']){
            Cadavre::getInstance()->update($id_cadavre,['date_fin_cadavre'=>$now]);
        }
    }
```