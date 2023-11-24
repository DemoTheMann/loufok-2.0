---
    sidebar_position: 10
---

# validationForm()

La méthode validationForm() de la classe CadavreModel prend en paramètre les informations du formulaire d'ajout d'un nouveau Cadavre et vérifie qu'elles sont toutes conformes.

Si aucune erreur n'est détectée, la méthode ne renvoit rien.
Si une ou plusieures erreurs sont détectées, alors la méthode renverra un tableau associatif contenant les messages d'erreurs.

Cette méthode fait appel au composant Validator de Symfony.

## Code

```php title="CadavreModel"
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
    public static function validationForm($formData)
    {
        $validator = Validation::createValidator();
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
```