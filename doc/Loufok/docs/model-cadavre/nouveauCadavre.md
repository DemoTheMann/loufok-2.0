---
    sidebar_position: 9
---

# nouveauCadavre()

La méthode nouveauCadavre() de la classe CadavreModel prend en paramètre l'identifiant de l'administrateur qui initie un nouveau Cadavre et les informations du formulaire d'enregistrement d'un nouveau cadavre.

Cette fonction ne renvoie rien, elle s'occupe seulement d'insérer un nouveau Cadavre dans la table de même nom dans la base de données.

Cette méthode fait appel à l'entitée :
- `Cadavre`

## Code

```php title="CadavreModel"
    /**
     * Ajout d'un nouveau cadavre exquis
     */
    public static function nouveauCadavre($userId, $formData){
        $titre_cadavre = trim(ucfirst(strtolower($formData['titre'])));
        $nb_contributions = $formData['nb_contributions_max'];
        $date_debut = $formData['debut_cadavre'];
        $date_fin = $formData['fin_cadavre'];
        Cadavre::getInstance()->create( 
            [
                'titre_cadavre' => $titre_cadavre,
                'nb_contributions' => $nb_contributions,
                'date_debut_cadavre' => $date_debut,
                'date_fin_cadavre' => $date_fin,
                'nb_contributions' => $nb_contributions,
                'nb_jaime' => 0,
                'id_administrateur' => $userId
            ]);
        //la je dois récup celui la et le return pour pouvoir le prendre dans nouvelleContribution
        return Cadavre::getInstance()->findBy(['titre_cadavre'=>$titre_cadavre]);
    }
```