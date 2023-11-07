<?php

declare (strict_types = 1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Entity\Contribution;
use App\Model\CadavreModel;

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
        $error = 0; 
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
            $cadavre = CadavreModel::getInstance();
            
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
                        $cadavre->nouvelleContribution($_SESSION['user'], $cadavre);
                    }
                }
            }
        }else{
            
            //méthode GET, aucune donnée à traiter
            $this->display('admin/admin.html.twig', ['user' => $_SESSION['user']]);
        }
    }


    public function affichageCadavre()
    {
        session_start();
        /**
         * cadavreEnCours renvoie un array :
         * cadavre_valide : cadavre en cours ou non (0 ou 1)
         * cadavre_en_cours : renvoie le cadavre ou 0 si aucun en cours
         */
        $cadavre = CadavreModel::getInstance()->cadavreEnCours($_SESSION['user']);
        
        //si aucun cadavre en cours, alors prévenir l'utilisateur du début du prochain cadavre
        if($cadavre[0] === 0){

            //dateProchainCadavre renvoie la phrase avec la prochaine date, ou rien si aucun cadavre prévu dans l'année qui suit
            $prochaine_date = CadavreModel::getInstance()->dateProchainCadavre(); 
            $this->display('admin/affichage_cadavre.html.twig', ['user' => $_SESSION['user'], 'prochaine_date' => $prochaine_date]);
        }else{
            $cadavre=$cadavre[1];
            $contributions = Contribution::getInstance()->findBy(['id_cadavre'=>$cadavre["id_cadavre"]]);
            var_dump($contributions);
            $this->display('admin/affichage_cadavre.html.twig', ['user' => $_SESSION['user'], 'cadavre' => $cadavre, 'contributions' => $contributions]);
        }
        
    }

}