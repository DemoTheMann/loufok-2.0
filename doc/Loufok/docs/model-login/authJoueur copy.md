---
    sidebar_position: 4
---

# logout()

La méthode logout() de la classe LoginModel ne prend pas de paramètres et effectue la déconnexion de l'utilisateur.

## Code

```php title="LoginModel.php"
public function logout()
    {
        session_unset();
        session_destroy();
    }
```