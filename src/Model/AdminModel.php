<?php

namespace App\Model;
use App\Entity\Admin;

class AdminModel
{

    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new (get_called_class())();
        }

        return self::$instance;
    }

    public static function getAdminName(int $id_admin)
    {
        $userInfo = Admin::getInstance()->findBy(['id_administrateur' => $id_admin])[0];
        return $userInfo['ad_mail_administrateur'];
    }
}