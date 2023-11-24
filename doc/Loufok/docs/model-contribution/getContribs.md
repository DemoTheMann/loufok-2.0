---
    sidebar_position: 7
---

# getContribs()

La méthode getContribs() de la classe ContributionModel prend en paramètre l'identifiant d'un cadavre et renvoit toutes les contributions qui lui sont associées.

La méthode renvoit un tableau associatif avec le `nom de plume` de la personne qui à écrit la contribution ainsi que le contenu textuel de la contribution.

Cette méthode fait appel aux entitées :
- `Contribution`
- `Joueur`

## Code

```php title="ContributionModel.php"
/**
     * Renvoie un array d'arrays avec deux données:
     *   contributions : texte de la contribution
     *   joueurs : pseudo du joueur
     */
    public static function getContribs($id_cadavre): array
    {
        $contribs = Contribution::getInstance()->findBy(['id_cadavre' => $id_cadavre]);
        $datas = [];
        $i = 0;
        foreach ($contribs as $contrib) {
            $i = $i+1;
            if ($contrib['id_joueur']) {
                $joueur = Joueur::getInstance()->findBy(['id_joueur' => $contrib['id_joueur']]);
                $joueur = $joueur[0]['nom_plume'];
            }else{
                $joueur = "";
            }
            $datas[$i] = [
                'contributions' => $contrib['texte_contribution'],
                'joueurs' => $joueur
            ];
        }
        return $datas;
    }
```