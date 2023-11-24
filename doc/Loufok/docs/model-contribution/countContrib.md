---
    sidebar_position: 4
---

# countContrib()

La méthode countContrib() de la classe ContributionModel prend en paramètre l'identifiant d'un cadavre et renvoit le nombre de contributions qui lui sont attribué.

Cette méthode fait appel aux entitées :
- `Contribution`

Cette méthode fait aussi appel au modèle :
- `CadavreModel` -> pour utiliser la méthode `cadavreEnCours()`

## Code

```php title="ContributionModel.php"
public static function countContrib(int $id_cadavre)
    {
        $activeCadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id_cadavre])[0];
        $cadavreCountContrib = count(Contribution::getInstance()->findBy(['id_cadavre' => $activeCadavre['id_cadavre']]));
        return $cadavreCountContrib;
    }
```