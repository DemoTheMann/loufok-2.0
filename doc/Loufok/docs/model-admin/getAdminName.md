---
    sidebar_position: 2
---

# getAdminName()

La méthode getAdminName() de la classe AdminModel prend en paramètre l'identifiant d'un administrateur et renvoie son adresse mail, ici utilisé comme son nom d'utilisateur.

## Code

```php title="AdminModel.php"
public static function getAdminName(int $id_admin)
    {
        $userInfo = Admin::getInstance()->findBy(['id_administrateur' => $id_admin])[0];
        return $userInfo['ad_mail_administrateur'];
    }
```