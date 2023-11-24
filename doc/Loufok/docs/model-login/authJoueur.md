---
    sidebar_position: 3
---

# authJoueur()

La méthode authJoueur() de la classe LoginModel prend en paramètre les informations renseignés dans le formulaire de connexion et vérifie si il est possible réaliser une connexion utilisateur.

Cette méthode fait appel a l'entitée :
- `Joueur`

## Code

```php title="LoginModel.php"
public function authJoueur(string $username, string $password):void
    {
        $joueur = Joueur::getInstance()->findBy(['nom_plume' => $username]);

        if($joueur && $password === $joueur[0]['mot_de_passe_joueur']) {
            $_SESSION['auth'] = true;
            $_SESSION['role'] = 'joueur';
            $_SESSION['user_id'] = $joueur[0]['id_joueur'];
        }
    }
```