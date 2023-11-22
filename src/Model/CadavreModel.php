<?php

namespace App\Model;
use App\Entity\Cadavre;
use App\Entity\Contribution;
use App\Entity\Joueur;
use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class CadavreModel extends Model
{

    /**
     * Renvoie les périodes de tous les cadavres exquis
     * dans array d'arrays avec deux données:
     *   contributions : texte de la contribution
     *   joueurs : pseudo du joueur
    */
    public static function periodes(){
        $cadavres = Cadavre::getInstance()->findAll();
        $periodes = [];
        $result = [];
        $i = 0;
        foreach ($cadavres as $cadavre) {
            $i = $i + 1;
            $periodes[$i] = 
            [
                'debut_cadavre' => $cadavre['date_debut_cadavre'],
                'fin_cadavre' => $cadavre['date_fin_cadavre']
            ];
            array_push($result, $periodes[$i]);
        }
        return $periodes;
    }

    /**
     * Renvoie les titres de tous les cadavre exquis
     */
    public static function titres(){
        $cadavres = Cadavre::getInstance()->findAll();
        $titres = [];
        foreach ($cadavres as $cadavre) {
            array_push($titres, $cadavre['titre_cadavre']);
        }
        return $titres;
    }

    /**
     * Renvoie un array d'arrays avec deux données:
     *   contributions : texte de la contribution
     *   joueurs : pseudo du joueur
     */
    public static function contributions($id_cadavre): array
    {
        $contributions = Contribution::getInstance()->findBy(['id_cadavre' => $id_cadavre]);
        $datas = [];
        $i = 0;
        foreach ($contributions as $c) {
            $i = $i+1;
            if ($c['id_joueur']) {
                $joueur = Joueur::getInstance()->findBy(['id_joueur' => $c['id_joueur']]);
                $joueur = $joueur[0]['nom_plume'];
            }else{
                $joueur = "";
            }
            $datas[$i] = [
                'contributions' => $c['texte_contribution'],
                'joueurs' => $joueur
            ];
        }
        return $datas;
    }

    /**
     * Renvoie le cadavre exquis en cours ou rien
     */
    public static function cadavreEnCours()
    {
        //renvoie le cadavre (array) en cours
        $ajd = date('Y-m-d');
        $cadavres = Cadavre::getInstance()->findAll();
        foreach ($cadavres as $cadavre => $c) {

            //si un cadavre exquis est en cours aujourd'hui
            if($c['date_debut_cadavre']<= $ajd && $c['date_fin_cadavre']>=$ajd){
            
                //récupérer les contributions du cadavre en cours pour vérif si le max n'a pas été atteint
                $contributions = Contribution::getInstance()->findBy(['id_'.$_SESSION['role'] => $_SESSION['user']['id_'.$_SESSION['role']], 'id_cadavre'=> $c['id_cadavre']]);
                $max_contribution = 0;
                foreach ($contributions as $contribution) {
                    $max_contribution = $max_contribution + 1; 
                }

                //si le max de contributions a été atteint : renvoie null
                if ($max_contribution >=$c['nb_contributions']) {
                    return null;
                }else{
                    //si le max de contributions n'a pas été atteint : affichage du cadavre en cours
                    return $c;
                }
            }
        }
    }

    /**
     * Récupère la date du prochain cadavre exquis. La méthode ne vérifie pas si 
     * un cadavre exquis est en cours, la vérification est à faire au préalable.
     */
    public static function dateProchainCadavre()
    {
        $cadavres = Cadavre::getInstance()->findAll();
        //Si le prochain cadavre exquis commence dans + d'1 an, date de référence
        $future_date = date('Y-m-d', strtotime('+1 year'));
        $min_date = $future_date;
        //récupérer les dates de chaque cadavre
        foreach ($cadavres as $cadavre => $c) {   
            //si la date de début est plus récente que la date de réf, on attribue sa valeur à min_date
            if($c['date_debut_cadavre']< $min_date){
                $min_date = $c['date_debut_cadavre'];
            }
        }
        //si la valeur de réf est tjrs là, alors le prochain cadavre exquis commence au minima
        //dans plus d'un an OU s'il n'y a pas de cadavre exquis prévu pour le moment.
        if($min_date===$future_date){
            $min_date = "Plus d'un an";
            return $min_date;
        }
        $date = date("d/m/Y", strtotime($min_date));
        return $date;
    }

    /**
     * Ne renvoie rien si aucun doublon dans les titres de cadavre exquis, renvoie un string de l'erreur si doublon
     */
    public static function titreUnique()
    {
        $titre_cadavre = trim(ucfirst(strtolower($_POST['titre_cadavre'])));
        $cadavres_existants = Cadavre::getInstance()->findAll();
        $errors = 0;
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

    public static function getActiveCadavre(): ?array
    {
        $now = time();
        $cadavres = Cadavre::getInstance()->findAll();
        foreach($cadavres as $cadavre => $c)
        {
            $date_debut = strtotime($c['date_debut_cadavre']);
            $date_fin = strtotime($c['date_fin_cadavre']);
            
            if($date_debut < $now && $date_fin > $now)
            {
                return $c;
            }
        }
    }
    /**
    * Ne renvoie rien si aucune période ne se chevauche, renvoie un string de l'erreur si chevauchement
    */
    public static function verificationPeriode(){
        $debut_cadavre = $_POST['debut_cadavre'];
        $fin_cadavre = $_POST['fin_cadavre'];
        $errors = 0;
        $cadavres_existants = Cadavre::getInstance()->findAll();
        foreach ($cadavres_existants as $cadavre => $c) {
            if ($debut_cadavre>=$c['date_debut_cadavre'] && $debut_cadavre<=$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
            
            if ($fin_cadavre>=$c['date_debut_cadavre'] && $fin_cadavre<=$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
            
            if ($debut_cadavre<=$c['date_debut_cadavre'] && $fin_cadavre>=$c['date_fin_cadavre']) {
                $errors = "Un cadavre exquis existe déjà pour la période du " . date("d/m/Y", strtotime($c['date_debut_cadavre'])) . " au " . date("d/m/Y", strtotime($c['date_fin_cadavre'])) . ". Le chevauchement de cadavre exquis n'est pas possible." ;
            }
        }
        if($errors){
            return $errors;
        }
    }

    /**
     * Ajout d'une nouvelle contribution
     */
    public static function nouvelleContribution($user, $cadavre){
        
        $texte_contribution = $_POST['contribution'];
        $ajd = date('Y-m-d');
        $contribition = Contribution::getInstance()->create(
            [
                'texte_contribution' => $texte_contribution,
                'date_soumission' => $ajd,
                'ordre_soumission' => 1,
                'id_administrateur' => $user['id_administrateur'],
                'id_cadavre' => $cadavre["id_cadavre"]
            ]);
    }    

    /**
     * Ajout d'un nouveau cadavre exquis
     */
    public static function nouveauCadavre($user){
        $titre_cadavre = trim(ucfirst(strtolower($_POST['titre_cadavre'])));
        $nb_contributions = $_POST['nb_contributions'];
        $date_debut = $_POST['debut_cadavre'];
        $date_fin = $_POST['fin_cadavre'];
        Cadavre::getInstance()->create( 
            [
                'titre_cadavre' => $titre_cadavre,
                'nb_contributions' => $nb_contributions,
                'date_debut_cadavre' => $date_debut,
                'date_fin_cadavre' => $date_fin,
                'nb_contributions' => $nb_contributions,
                'nb_jaime' => 0,
                'id_administrateur' => $user['id_administrateur']
            ]);
        //la je dois récup celui la et le return pour pouvoir le prendre dans nouvelleContribution
        return Cadavre::getInstance()->findBy(['titre_cadavre'=>$titre_cadavre]);
    }
    
    /**
     * Vérification des inputs du formulaire : 
     *      tous les champs doivent être remplis,
     *      les dates ne doivent pas être passées,
     *      la date de fin doit être après ou égale la date de début,
     *      le nombre de contributions max doit être un chiffre entier,
     *      le nombre de contributions max doit être supérieur à 2,
     *      La contribution doit contenir au moins 50 caractères,
     *      La contribution ne doit pas contenir plus de 280 caractères.
     * 
     * Ne renvoie rien si toutes les conditions sont réunies, sinon renvoie un tableau associatif des erreurs :
     *      [
     *          'titre_cadavre' => ...,
     *          'debut_cadavre' => ...,
     *          'fin_cadavre' => ...,
     *          'nb_contributions' => ...,
     *          'contribution' => ...
     *      ]
     *      ( min : une erreur, max : 5 erreurs )
     */
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

        $ajd = date('Y-m-d', strtotime('today UTC'));

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
                new Assert\GreaterThanOrEqual([
                    'value' => $ajd,
                    'message' => 'La date ne peut pas déjà être passée',
                ]),
            ],
            'fin_cadavre' => [
                new Assert\NotBlank([
                    'message' => 'Ce champ doit être rempli',
                ]),
                new Assert\Date([
                    'message' => 'Vous devez rentrez une date',
                ]),
                new Assert\GreaterThanOrEqual([
                    'value' => $ajd,
                    'message' => 'La date ne peut pas déjà être passée',
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