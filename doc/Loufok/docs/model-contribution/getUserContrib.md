---
    sidebar_position: 6
---

# getUserContrib()

La méthode getUserContrib() de la classe ContributionModel prend en paramètre l'identifiant d'un utilisateur et recherche la contribution de l'utilisateur pour le cadavre en cours, pour vérifier si le joueur à déjà participer à un cadavre ou non.

Si la contribution existe, la méthode la renvoit.
Si la contribution n'existe pas, la méthode renvoit `null`

Cette méthode fait appel aux entitées :
- `Contribution`

Cette méthode fait aussi appel au modèle :
- `CadavreModel` -> pour utiliser la méthode `cadavreEnCours()`

## Code

```php title="ContributionModel.php"
public static function getUserContrib(int $user_id)
    {
        $activeCadavre = CadavreModel::getInstance()->cadavreEnCours();
        $id_cadavre = $activeCadavre['id_cadavre'];
        $userContrib = Contribution::getInstance()->findBy(['id_joueur'=>$user_id,'id_cadavre'=>$id_cadavre]);
        return $userContrib;
    }
```