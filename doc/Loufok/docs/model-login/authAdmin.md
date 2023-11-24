---
    sidebar_position: 2
---

# authAdmin()

La méthode authAdmin() de la classe LoginModel prend en paramètre les informations renseignés dans le formulaire de connexion et vérifie si il est possible réaliser une connexion administrateur.

Cette méthode fait appel a l'entitée :
- `Admin`

## Code

```php title="LoginModel.php"
public function authAdmin(string $email, string $password):void
    {
        $admin = Admin::getInstance()->findBy(['ad_mail_administrateur' => $email]);

        if ($admin && $password === $admin[0]['mot_de_passe_administrateur']) {
            $_SESSION['auth'] = true;
            $_SESSION['role'] = 'administrateur';
            $_SESSION['user_id'] = $admin[0]['id_administrateur'];
        }
    }
```