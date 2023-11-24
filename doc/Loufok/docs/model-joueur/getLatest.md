---
    sidebar_position: 3
---

# getLatest()

La méthode getLatest() de la classe JoueurModel prend en paramètre l'identifiant d'un joueur et renvoit les informations du dernier Cadavre Exquis auquel il à participé.

Cette méthode fait appel a l'entitée :
- `Contribution`
- `Cadavre`

Cette méthode fait aussi appel au modèle :
- `CadavreModel` -> pour utiliser la méthode `isCadavreOn()`

## Code

```php title="JoueurModel.php"
public static function getlatest(int $user_id): ?array
    {
        $latestContrib = Contribution::getInstance()->getUserLatest($user_id);
        $latestCadavre = null;
        if($latestContrib)
        {
            $isCadavreOn = CadavreModel::getInstance()->isCadavreOn($latestContrib['id_cadavre']);
            
            if($isCadavreOn)
            {
                return null;
            }

            $latestCadavre = Cadavre::getInstance()->findBy(['id_cadavre' => $latestContrib['id_cadavre']])[0];
        }
        
        return $latestCadavre;

    }
```