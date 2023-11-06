(function () {
    const App = {
      // les variables/constantes
      _nbContributions: document.querySelector("#nb_contributions"),
      _dateDebutCadavre: document.querySelector('#debut_cadavre'),
      _dateFinCadavre: document.querySelector('#fin_cadavre'),
      _form: document.querySelector("#newCadavre__form"),
      _nouvContribution: document.querySelector("#contribution"),
      _nbChara: document.querySelector("#newContribution__info"),
      _btnForm: document.querySelector("#btn_submit"),
      
      // initialisations
      app_init: function () {
        App.app_handlers();
      },
  
      // les gestionnaires d'ev
      app_handlers: function () {
        App._dateFinCadavre.addEventListener("input", App.verification);
        App._nbContributions.addEventListener("input", App.maxContributionVerification);
        App._dateDebutCadavre.addEventListener("input", App.debutCadavreVerification);
        App._nouvContribution.addEventListener("input", App.nouvelleContribution);
      },
      
      verification: () => {
        if (App._dateFinCadavre.value < App._dateDebutCadavre.value) {
          App._dateFinCadavre.setCustomValidity("La date de fin doit arriver après la date de début.");
        }else{
          App._dateFinCadavre.setCustomValidity("");
        }
      },

      debutCadavreVerification: () => { 
        const date = new Date(App._dateDebutCadavre.value);
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        
        if (date < yesterday) {
            App._dateDebutCadavre.setCustomValidity("La date ne peut pas être passée.");
        } else {
            App._dateDebutCadavre.setCustomValidity("");
        }
      },

      maxContributionVerification: () => {
        const nbContributionsValue = parseInt(App._nbContributions.value, 10); // Convertir la valeur en entier
        // Vérifiez le minimum
        if (nbContributionsValue < 2) {
          App._nbContributions.setCustomValidity("La valeur doit être supérieure ou égale à 2.");
        } else {
          // Vérifiez le pattern
          const pattern = /^[1-9][0-9]*$/;
          if (!pattern.test(App._nbContributions.value)) {
            App._nbContributions.setCustomValidity("Le format est incorrect, vous devez rentrer un nombre entier, comme 2  ou 3.");
          } else {
            // Réinitialisez toute validation personnalisée
            App._nbContributions.setCustomValidity("");
          }
        }
      },

      nouvelleContribution: () => {
        const val = App._nouvContribution.value.length;
        App._nbChara.innerHTML = "Vous avez " + val + " caractères. Vous devez avoir entre 50 et 280 caractères.";
          // Taille minimum : 50
        if (val < 50) {
          App._nouvContribution.setCustomValidity("La contribution minimum est de 50 caractères. Vous avez " + val + " caractères.");
          App._btnForm.disabled = true;
        }
        // Taille maximum : 280
        else if (val > 280) {
          App._nouvContribution.setCustomValidity("La contribution maximum est de 280 caractères. Vous avez " + val + " caractères.");
          App._btnForm.disabled = true;
        } else {
          App._btnForm.disabled = false;
          App._nouvContribution.setCustomValidity("");
        }
      }

    };
    window.addEventListener("DOMContentLoaded", App.app_init);
  })();