---
    sidebar_position: 7
---

# titreUnique()

La méthode titreUnique() de la classe CadavreModel prend le titre d'un nouveau cadavre exquis en paramètre et vérifie si ce titre n'exite pas déjà dans les cadavres déjà enregistrés.
Si le test ne trouve pas de doublons il ne renvoit rien.
Si le titre existe déjà il renvoie le message d'erreur en string.

Cette méthode fait appel aux entitées :
- `Cadavre`

## Code

```php title="CadavreModel"
    /**
     * Ne renvoie rien si aucun doublon dans les titres de cadavre exquis, renvoie un string de l'erreur si doublon
     */
    public static function titreUnique($titre)
    {
        $titre_cadavre = trim(ucfirst(strtolower($titre)));
        $cadavres_existants = Cadavre::getInstance()->findAll();
        $errors = 0;
        foreach ($cadavres_existants as $cadavre => $c) {
            $titre_a_comparer = trim(ucfirst(strtolower($c['titre_cadavre'])));
            if($titre_cadavre === $titre_a_comparer){
                $errors = "Un cadavre exquis a déjà le titre \"" . $titre_cadavre . "\", veuillez changer.";
            }
        }
        if($errors){
            return $errors;
        }
    }
```