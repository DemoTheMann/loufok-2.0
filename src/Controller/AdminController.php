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
        
        $periodes = CadavreModel::getInstance()->periodes();
        $titres = CadavreModel::getInstance()->titres();

        $this->display('admin/admin.html.twig', 
            [
                'user' => $_SESSION['user'],
                'error' => 0,
                'periodes' => json_encode($periodes),
                'titres' => json_encode($titres)
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
                vérifier la vadilité : s'il y a des erreurs, alors elles sont renvoyés, sinon rien.
                si rien n'est renvoyé, formulaire valide : 
                    vérification titre identiques puis périodes
              */
            $cadavre = CadavreModel::getInstance();
            
            //variables pour les vérifications en front
            $periodes = CadavreModel::getInstance()->periodes();
            $titres = CadavreModel::getInstance()->titres();            

            //validationForm renvoie errors[] si problèmes de validation, sinon rien 
            // Créez un tableau associatif avec les données du formulaire
            $formData = [
                'titre' => $_POST['titre_cadavre'],
                'debut_cadavre' => $_POST['debut_cadavre'],
                'fin_cadavre' => $_POST['fin_cadavre'],
                'nb_contributions_max' => $_POST['nb_contributions'],
                'contribution' => $_POST['contribution'],
            ];
            $formulaire_errors = $cadavre->validationform($formData);
            if ($formulaire_errors = null) {
                $this->display('admin/admin.html.twig', 
                [
                    'user' => $_SESSION['user'],
                    'global_message' => "Le cadavre exquis n'a pas été enregistré 
                                            car des erreurs ont été rencontrées. Merci
                                            de bien vouloir recommencer.",
                    'errors_message' => $formulaire_errors,
                    'periodes' => json_encode($periodes),
                    'titres' => json_encode($titres)
                ]);
            }else{
                //vérification qu'il n'y ai pas de doublons de titres dans la BDD
                $verif_titre = $cadavre->titreUnique($formData['titre']);
                
                if($verif_titre){
                    $this->display('admin/admin.html.twig', 
                    [
                    'user' => $_SESSION['user'],
                    'global_message' => "Le cadavre exquis n'a pas été enregistré car
                                            un cadavre exquis a déjà ce titre.",
                    'errors_message' => $verif_titre,
                    'periodes' => json_encode($periodes),
                    'titres' => json_encode($titres)
                    ]);
                }else{
                    //verificationPeriode renvoie un message d'erreur s'il y a chevauchement de période 
                    $verif_periode = $cadavre->verificationPeriode($formData['debut_cadavre'], $formData['fin_cadavre']);
                    if ($verif_periode) {
                        $this->display('admin/admin.html.twig',
                        [
                            'user' => $_SESSION['user'],
                            'global_message' => "Le cadavre exquis n'a pas été enregistré car
                                                    il chevauche une période déjà enregistrée.",
                            'errors_message' => $verif_periode,
                            'periodes' => json_encode($periodes),
                            'titres' => json_encode($titres)
                        ]);
                    }else{
                        //toutes les conditions ont été vérifiées; le nouveau cadavre exquis peut être enregistré
                        $creationCadavre = $cadavre->nouveauCadavre($_SESSION['user']);
                        $cadavre->nouvelleContribution($_SESSION['user'], $creationCadavre[0], $formData['contribution']);
                        $this->display('admin/admin.html.twig',
                        [
                            'user' => $_SESSION['user'],
                            'global_message' => "Le cadavre exquis a bien été créé !",
                            'errors_message' => 0,
                            'periodes' => json_encode($periodes),
                            'titres' => json_encode($titres)
                        ]);
                    }    
                }
            }
        }else{

            //méthode GET, aucune donnée à traiter
            $this->display('admin/admin.html.twig', 
            [
                'user' => $_SESSION['user'],
                'errors' => 0,
                'errors_message' => 0,
                'periodes' => json_encode($periodes),
                'titres' => json_encode($titres)
            ]);
        }
    }


    public function affichageCadavre()
    {
        session_start();

        //*CadavreEnCours* renvoie le cadavre ou rien s'il n'y en a pas en cours actuellement
        $cadavre = CadavreModel::getInstance()->cadavreEnCours();
        //si aucun cadavre en cours, alors prévenir l'utilisateur du début du prochain cadavre
        if(!$cadavre){
            //*dateProchainCadavre* renvoie la phrase avec la prochaine date, ou rien si aucun cadavre prévu dans l'année qui suit
            $prochaine_date = CadavreModel::getInstance()->dateProchainCadavre(); 
            $this->display('admin/affichage_cadavre.html.twig', ['user' => $_SESSION['user'], 'prochaine_date' => $prochaine_date]);
        }else{
            /**
             * La méthode *contributions* renvoie un array composé de 2 arrays:
             *   contributions : texte de la contribution
             *   joueurs : pseudo du joueur
             */
            $contributions = CadavreModel::getInstance()->contributions($cadavre["id_cadavre"]);
            $this->display('admin/affichage_cadavre.html.twig', ['user' => $_SESSION['user'], 'cadavre' => $cadavre, 'contributions' => $contributions]);
        }
        
    }

}