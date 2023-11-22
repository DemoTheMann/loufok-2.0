(
  function () {
    const App = {
      // les variables/constantes
      _nbContributions: document.querySelector("#nb_contributions"),
      _dateDebutCadavre: document.querySelector('#debut_cadavre'),
      _dateFinCadavre: document.querySelector('#fin_cadavre'),
      _form: document.querySelector("#newCadavre__form"),
      _titreCadavre: document.querySelector("#titre_cadavre"),

      _errorContribution: document.querySelector('.error__contribution'),
      _errorTitreCadavre: document.querySelector('.error__titre_cadavre'),
      _errorDebutCadavre: document.querySelector('.error__debut_cadavre'),
      _errorFinCadavre: document.querySelector('.error__fin_cadavre'),
      _errorNbContributions: document.querySelector('.error__nb_contributions'),

      _nouvContribution: document.querySelector("#contribution"),
      _nbChara: document.querySelector("#newContribution__info"),
      _btnForm: document.querySelector("#btn_submit"),
      
      // initialisations
      app_init: function () {
        App.app_handlers();
      },
  
      // les gestionnaires d'ev
      app_handlers: function () {
        App._titreCadavre.addEventListener("input", App.titreVerification);
        App._dateDebutCadavre.addEventListener("change", App.verification);
        App._dateDebutCadavre.addEventListener("change", App.debutCadavreVerification);
        App._dateDebutCadavre.addEventListener("change", App.periodeVerification);
        App._dateFinCadavre.addEventListener("change", App.verification);
        App._dateFinCadavre.addEventListener("change", App.periodeVerification);
        App._nbContributions.addEventListener("input", App.maxContributionVerification);
        App._nouvContribution.addEventListener("input", App.nouvelleContribution);
        App._form.addEventListener("submit", App.submitValid);
      },
      
      periodeVerification: ()=>{
        Object.keys(periodes).forEach(key => {
          const p = periodes[key];
          const debutCadavre = App._dateDebutCadavre.value;
          const finCadavre = App._dateFinCadavre.value;

          function dateConvertisseur(dateString) {
            let components = dateString.split('-');
            if (components.length === 3) {
              // Rearrange the components to the "dd-mm-yyyy" format
              let dd_mm_yyyy = components[2] + '/' + components[1] + '/' + components[0];
              return dd_mm_yyyy;
            } else {
              return "Invalid date format";
            }
          }
                    
          if(debutCadavre >= p['debut_cadavre'] && debutCadavre <=p['fin_cadavre'] ){
            App._errorFinCadavre.textContent = "Un cadavre exquis existe déjà pour la période du "+ dateConvertisseur(p['debut_cadavre'])+" au "+dateConvertisseur(p['fin_cadavre']);
          }else if(finCadavre>=p['debut_cadavre'] && finCadavre<=p['fin_cadavre']){
            App._errorFinCadavre.textContent = "Un cadavre exquis existe déjà pour la période du "+ dateConvertisseur(p['debut_cadavre'])+" au "+dateConvertisseur(p['fin_cadavre']);
          }else if(debutCadavre<=p['debut_cadavre'] && finCadavre>=p['fin_cadavre']){
            App._errorFinCadavre.textContent = "Un cadavre exquis existe déjà pour la période du "+ dateConvertisseur(p['debut_cadavre'])+" au "+dateConvertisseur(p['fin_cadavre']);
          }
        });
      },

      titreVerification: () =>{
        App._errorTitreCadavre.textContent = "";  
        titres.forEach(titre => {
          const titreCadavre = App._titreCadavre.value.trim().toLowerCase();
          const titreEnCours = titre.trim().toLowerCase();
          if(titreEnCours === titreCadavre){
            App._errorTitreCadavre.textContent = "Un cadavre exquis porte déjà le titre de «"+ titreEnCours + "»";
          }
          
        });
        
      },

      submitValid: (e) => {
        switch (true) {
          case App._errorContribution.innerHTML != "":
          case App._errorDebutCadavre.innerHTML != "":
          case App._errorFinCadavre.innerHTML != "":
          case App._errorNbContributions.innerHTML != "":
          case App._errorTitreCadavre.innerHTML != "":
            e.preventDefault();
            break;
            default:
              // Si aucun message d'erreurs, soumission du formulaire
          break;
        }
      },

      verification: () => {
        if (App._dateFinCadavre.value < App._dateDebutCadavre.value) {
          App._errorFinCadavre.innerHTML = "La date de fin doit arriver après la date de début.";
          App._btnForm.disabled = true;
        }else{
          App._errorFinCadavre.innerHTML = "";
          App._btnForm.disabled = false;
        }
      },

      debutCadavreVerification: () => { 
        const date = new Date(App._dateDebutCadavre.value);
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        
        if (date < yesterday) {
          App._errorDebutCadavre.innerHTML = "La date ne peut pas être passée.";
          App._btnForm.disabled = true;
        } else {
          App._errorDebutCadavre.innerHTML = "";
          App._btnForm.disabled = false;
        }
      },

      maxContributionVerification: () => {
        const nbContributionsValue = parseInt(App._nbContributions.value, 10); // Convertir la valeur en entier
        // Vérifiez le minimum
        if (nbContributionsValue < 2) {
          App._errorNbContributions.innerHTML = "La valeur doit être supérieure ou égale à 2.";
          App._btnForm.disabled = true;
        } else {
          // Vérifiez le pattern
          const pattern = /^[1-9][0-9]*$/;
          if (!pattern.test(App._nbContributions.value)) {
            App._errorNbContributions.innerHTML = "Le format est incorrect, vous devez rentrer un nombre entier, comme 2  ou 3.";
          } else {
            // Réinitialisez toute validation personnalisée
            App._errorNbContributions.innerHTML = "";
            App._btnForm.disabled = false;
          }
        }
      },

      nouvelleContribution: () => {
        const val = App._nouvContribution.value.length;
        App._nbChara.innerHTML = "Vous avez " + val + " caractères. Vous devez avoir entre 50 et 280 caractères.";
          // Taille minimum : 50
        if (val < 50) {
          App._errorContribution.innerHTML ="La contribution minimum est de 50 caractères. Vous avez " + val + " caractères.";
          App._btnForm.disabled = true;
        }
        // Taille maximum : 280
        else if (val > 280) {
          App._errorContribution.innerHTML = "La contribution maximum est de 280 caractères. Vous avez " + val + " caractères.";
          App._btnForm.disabled = true;
        } else {
          App._btnForm.disabled = false;
          App._errorContribution.innerHTML = "";
        }
      }

    };
    window.addEventListener("DOMContentLoaded", App.app_init);
  })();

  