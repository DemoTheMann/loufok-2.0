<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Login;
use App\Entity\Cadavre;

class AdminController extends Controller
{
    public function admin()
    {
        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }else{

            if(!isset($_SESSION['auth']))
            {
                HTTP::redirect('/loufok/login');
            }
        $error = ""; 
        $this->display('admin/admin.html.twig', 
            [
                'user' => $_SESSION['user'],
                'error' => $error
            ]);
        }
    }

    public function nouveauCadavre()
    {
        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            /**
             * Les vérifications à exécuter : 
             * 
             * vérifier que tous les champs soient valides
             * vérifier qu'aucun cadavre n'a de titres identiques
             * vérifier qu'aucune période ne se chevauche
             */

             /**
              * la logique de traitement : 
                vérifier la vadilité : s'il y a des erreurs, alors elles sont renvoyés, sinon rien
                si rien n'est renvoyé, formulaire valide : 
                    vérification titre identiques puis périodes
              */
            $cadavre = Cadavre::getInstance();
            
            //validationForm renvoie errors[] si problèmes de validation, sinon rien 
            $formulaire_errors = $cadavre->validationform();
            if ($formulaire_errors) {
                $this->display('admin/admin.html.twig', ['user' => $_SESSION['user'], 'errors' => $formulaire_errors, 'errors_message' => 0]);
            }else{

                //vérification qu'il n'y ai pas de duplicata de titres dans la BDD
                $verif_titre = $cadavre->titreUnique();
                
                if($verif_titre){
                    $this->display('admin/admin.html.twig', ['user' => $_SESSION['user'], 'errors' => 0, 'errors_message' => $verif_titre]);
                }else{
                    //verificationPeriode renvoie un message d'erreur s'il y a chevauchement de période 
                    $verif_periode = $cadavre->verificationPeriode();
                
                    if ($verif_periode) {
                        $this->display('admin/admin.html.twig', ['user' => $_SESSION['user'], 'errors' => 0, 'errors_message' => $verif_periode]);
                    }else{
                        //toutes les conditions ont été vérifiées; le nouveau cadavre exquis peut être enregistré
                        $cadavre->nouveauCadavre($_SESSION['user']);
                    }
                }
            }
        }else{
            
            //$error = "Le formulaire n'a pas été envoyé, une erreur est survenue. Veuillez réessayer.";
            $this->display('admin/admin.html.twig', ['user' => $_SESSION['user']]);
        }
    }

}