---
    sidebar_position: 8
---

# nouvelleContribution()

La méthode nouvelleContribution() de la classe CadavreModel prend en paramètre l'identifiant de l'administrateur qui initie un nouveau cadavre, les informations du nouveau Cadavre Exquis et le contenu texte de la contribution.

Cette fonction ne renvoie rien, elle s'occupe seulement d'insérer la première contribution d'ordre 1 à l'instantiation d'un nouveau cadavre par un administrateur.

Cette méthode fait appel à l'entitée :
- `Contribution`

## Code

```php title="CadavreModel"
    /**
     * Ajout de la première contribution d'un nouveau cadavre
     */
    public static function nouvelleContribution($userId, $cadavre, $contribution){
        
        $texte_contribution = $contribution;
        $ajd = date('Y-m-d');
        Contribution::getInstance()->create(
            [
                'texte_contribution' => $texte_contribution,
                'date_soumission' => $ajd,
                'ordre_soumission' => 1,
                'id_administrateur' => $userId,
                'id_cadavre' => $cadavre["id_cadavre"]
            ]);
    }    
```