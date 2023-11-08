<?php

namespace App\Model;
use App\Entity\Cadavre;
use App\Entity\Contribution;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class CadavreModel extends Model
{

    public static function cadavreEnCours($user)
    {
        //cadavre_en_cours = le cadavre (array) en cours
        //cadavre_valide = 0 ou 1, si un cadavre est actuellement en cours
        $ajd = date('Y-m-d');
        $cadavres = Cadavre::getInstance()->findAll();
        foreach ($cadavres as $cadavre => $c) {

            //si un cadavre exquis est en cours aujourd'hui
            if($c['date_debut_cadavre']<= $ajd && $c['date_fin_cadavre']>=$ajd){
            
                //récupérer les contributions, voir si le max n'a pas été atteint
                $contributions = Contribution::getInstance()->findBy(['id_administrateur' => $user['id_administrateur'], 'id_cadavre'=> $c['id_cadavre']]);
                $max_contribution = 0; 
                foreach ($contributions as $contribution) {
                    $max_contribution = $max_contribution + 1; 
                }
                //si le max de contributions a été atteint : affichage de l'ancien cadavre
                if ($max_contribution >=$c['nb_contributions']) {
                    $cadavre_valide = 0;
                    $cadavre_en_cours = $c; 
                    return [$cadavre_valide, $cadavre_en_cours];
            
                    //si le max de contributions n'a pas été atteint : affichage du cadavre en cours
                }else{
                    $cadavre_valide = 1;
                    $cadavre_en_cours = $c;
                    return [$cadavre_valide, $cadavre_en_cours];
                }
            }else{
                $cadavre_valide = 0;
                $cadavre_en_cours = 0;
            }
        }
        return [$cadavre_valide, $cadavre_en_cours];
    }

    public static function dateProchainCadavre()
    {
        $cadavres = Cadavre::getInstance()->findAll();
        $future_date = date('Y-m-d', strtotime('+1 year'));
        $min_date = $future_date;
        foreach ($cadavres as $cadavre => $c) {   
            if($c['date_debut_cadavre']< $min_date){
                $min_date = $c['date_debut_cadavre'];
            }
        }
        if($min_date===$future_date){
            $min_date = "";
            return $min_date;
        }
        $min_date = date($min_date);
        $date = date("d/m/Y", strtotime($min_date));
        $min_date = "Le prochain cadavre exquis commencera le " . $date . ".";
        return $min_date;
    }

    public static function titreUnique()
    {
        $titre_cadavre = trim(ucfirst(strtolower($_POST['titre_cadavre'])));
        $cadavres_existants = Cadavre::getInstance()->findAll();
        foreach ($cadavres_existants as $cadavre => $c) {
            $titre_a_comparer = trim(ucfirst(strtolower($c['titre_cadavre'])));
            if($titre_cadavre === $titre_a_comparer){
                $errors = "Un cadavre exquis a déjà le titre \"" . $titre_cadavre . "\", veuillez changer.";
            }
        }
        if($errors){
            return $errors;
        }
    }

    public static function verificationPeriode(){
        $debut_cadavre = $_POST['debut_cadavre'];
        $fin_cadavre = $_POST['fin_cadavre'];
        $errors = 0;
        $cadavres_existants = Cadavre::getInstance()->findAll();
        foreach ($cadavres_existants as $cadavre => $c) {
            if ($debut_cadavre>$c['date_debut_cadavre'] && $debut_cadavre<$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
            
            if ($fin_cadavre>$c['date_debut_cadavre'] && $fin_cadavre<$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
        }
        if($errors){
            return $errors;
        }
    }

    public static function nouvelleContribution($user, $cadavre){
        
        $texte_contribution = $_POST['contribution'];
        $ajd = date('Y-m-d');
        Contribution::getInstance()->create(
            [
                'texte_contribution' => $texte_contribution,
                'date_soumission' => $ajd,
                'ordre_soumission' => 1,
                'id_administrateur' => $user['id_administrateur'],
                'id_cadavre' => $cadavre["id_cadavre"]
            ]);
    }    

    public static function nouveauCadavre($user){
        $titre_cadavre = trim(ucfirst(strtolower($_POST['titre_cadavre'])));
        $nb_contributions = $_POST['nb_contributions'];
        Cadavre::getInstance()->create( 
            [
                'titre_cadavre' => $titre_cadavre,
                'nb_contributions' => $nb_contributions,
                'nb_jaime' => 0,
                'id_administrateur' => $user['id_administrateur']
            ]);
    }
    
    public static function validationForm()
    {
        $validator = Validation::createValidator();

        //$timestamp = date("Y-m-d", strtotime($_POST['debut_cadavre']));
        //var_dump($debut_cadavre);

        // Créez un tableau associatif avec les données du formulaire
        $formData = [
            'titre' => $_POST['titre_cadavre'],
            'debut_cadavre' => $_POST['debut_cadavre'],
            'fin_cadavre' => $_POST['fin_cadavre'],
            'nb_contributions_max' => $_POST['nb_contributions'],
            'contribution' => $_POST['contribution'],
        ];

        var_dump($formData['debut_cadavre']);
        // Créez un objet de contraintes de validation
        $constraints = new Assert\Collection([
            'titre' => [
                new Assert\NotBlank([
                    'message' => 'Ce champ doit être rempli',
                ])
            ],
            'debut_cadavre' => [
                new Assert\NotBlank([
                    'message' => 'Ce champ doit être rempli',
                ]),
                new Assert\Date([
                    'message' => 'Vous devez rentrez une date',
                ]),
                new Assert\Range([
                    'min' => 'today',
                    'minMessage' => 'La date ne peut pas déjà être passée',
                ]),
            ],
            'fin_cadavre' => [
                new Assert\NotBlank([
                    'message' => 'Ce champ doit être rempli',
                ]),
                new Assert\Range([
                    'min' => 'debut_cadavre',
                    'minMessage' => 'La date ne peut pas déjà être passée',
                ]),
            ],
            'nb_contributions_max' => [
                new Assert\NotBlank([
                    'message' => 'Ce champ doit être rempli',
                ]),
                new Assert\Regex([
                    'pattern' => '/^[1-9][0-9]*$/',
                    'message' => 'La valeur doit être un nombre entier (pas de chiffres après la virgule)',
                ]),
                new Assert\Positive([
                    'message' => 'La valeur doit être positive',
                ]),
                new Assert\GreaterThanOrEqual([
                    'value' => 2,
                    'message' =>"La valeur doit être égale ou supérieure à 2",
                ]),
            ],
            'contribution' => [
                new Assert\NotBlank([
                    'message' => 'Ce champ doit être rempli',
                ]),
                new Assert\Length([
                    'min' => 50,
                    'max' => 280,
                    'minMessage' => 'Le texte doit contenir au moins 50 caractères',
                    'maxMessage' => 'Le texte ne peut pas contenir plus de 280 caractères',
                ]),
            ],
        ]);

        // Validez les données du formulaire
        $violations = $validator->validate($formData, $constraints);
        $errors = [];
        if (0 !== count($violations)) {
            // Le formulaire n'est pas valide, récupérer les erreurs pour les afficher
            foreach ($violations as $violation) {
                $field = str_replace(['[', ']'], '', $violation->getPropertyPath());
                $message = $violation->getMessage();
                $errors[$field] = $message;
            }
            return $errors;
        }
    }
}