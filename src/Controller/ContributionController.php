<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Entity\Cadavre;

class ContributionController extends Controller
{
    public function contribution()
    {
        session_start();

        if(!isset($_SESSION['auth']))
        {
            HTTP::redirect('/loufok/login');
        }

        $cadavreModel = Cadavre::getInstance();

    }
}