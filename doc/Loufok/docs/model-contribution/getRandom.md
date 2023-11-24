---
    sidebar_position: 2
---

# getRandom()

La méthode getRandom() de la classe ContributionModel prend en paramètre l'identifiant d'un joueur pour trouver la contribution aléatoirement choisit pour la Cadavre Exquis en cours actuellement afin qu'il puisse s'en inspirer pour écrire sa propre contribution.

Si la contribution choisit aléatoirement existe, la fonction renvoit la contribution en question.
Si la contribution choisit aléatoirement n'existe pas, la fonction renvoit `null`.

Cette méthode fait appel aux entitées :
- `Contribution`
- `ContributionAléatoire`

Cette méthode fait aussi appel au modèle :
- `CadavreModel` -> pour utiliser la fonction `cadavreEnCours()`

## Code

```php title="ContributionModel.php"
public static function getRandom(int $id_joueur)
    {
        $random = null;
        $activeCadavre = CadavreModel::getInstance()->cadavreEnCours();
        $contribAleaModel = ContributionAleatoire::getInstance();
        // var_dump($activeCadavre);
        $contribAleatoire = $contribAleaModel->findBy(
            [
                'id_joueur' => $id_joueur,
                'id_cadavre' => $activeCadavre['id_cadavre'],
            ]);
            // var_dump($contribAleatoire);
        if($contribAleatoire){
            $random = Contribution::getInstance()->findBy(['id_contribution'=>$contribAleatoire['num_contribution']])[0];
            var_dump($contribAleatoire);
        }
        return $random;
    }
```