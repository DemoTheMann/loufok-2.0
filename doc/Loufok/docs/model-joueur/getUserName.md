---
    sidebar_position: 2
---

# getUserName()

La méthode getUserName() de la classe JoueurModel prend en paramètre l'identifiant d'un joueur et renvoit son `nom de plume`.

Cette méthode fait appel a l'entitée :
- `Joueur`

## Code

```php title="JoueurModel.php"
public static function getUserName(int $id_joueur)
    {
        $userInfo = Joueur::getInstance()->findBy(['id_joueur' => $id_joueur]);
        return $userInfo[0]['nom_plume'];
    }
```