<?php

namespace App\Model;
use App\Entity\Cadavre;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class CadavreModel extends Model
{

    public static function titreUnique()
    {
        $titre_cadavre = $_POST['titre_cadavre'];
        $cadavres_existants = Cadavre::getInstance()->findAll();
        foreach ($cadavres_existants as $cadavre => $c) {
            if($titre_cadavre === $c['titre_cadavre']){
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

    public static function nouveauCadavre($user){
        $titre_cadavre = $_POST['titre_cadavre'];
        $nb_contributions = $_POST['nb_contributions'];
        $nouveauCadavre = Cadavre::getInstance()->create( 
            [
                'titre_cadavre' => $titre_cadavre,
                'nb_contributions' => $nb_contributions,
                'nb_jaime' => 0,
                'id_administrateur' => $user['id_administrateur']
            ] );
        //return Cadavre::getInstance()->findBy(['id_administrateur' => $user['id_administrateur'], 'titre_cadavre' => $titre_cadavre]);
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
                new Assert\Regex([
                    'pattern' => '([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))',
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