---
    sidebar_position: 3
---

# setRandom()

La méthode setRandom() de la classe ContributionModel prend en paramètre l'identifiant d'un joueur pour définir la contribution choisit aléatoirement qui lui sera rattaché pour la Cadavre Exquis en cours.

Lorsque la contribution choisit aléatoirement à été ajoutée, la méthode la renvoit.

Cette méthode fait appel aux entitées :
- `Contribution`
- `ContributionAléatoire`

Cette méthode fait aussi appel au modèle :
- `CadavreModel` -> pour utiliser la méthode `cadavreEnCours()`

## Code

```php title="ContributionModel.php"
public static function setRandom(int $id_joueur)
    {
        $activeCadavre = CadavreModel::getInstance()->cadavreEnCours();
        //var_dump($activeCadavre);
        $cadavreCountContrib = count(Contribution::getInstance()->findBy(['id_cadavre' => $activeCadavre['id_cadavre']]));
        $random = random_int(1, $cadavreCountContrib);
        $randomContrib = Contribution::getInstance()->findBy(['ordre_soumission' => $random])[0];
        $contribAleatoire = ContributionAleatoire::getInstance()->create(
            [ 
                'id_joueur' => $id_joueur,
                'id_cadavre' => $randomContrib['id_cadavre'],
                'num_contribution' => $randomContrib['id_contribution']
            ]); 
            // var_dump($randomContrib);
        return $contribAleatoire;
    }
```