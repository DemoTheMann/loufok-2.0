(
    function () {
        const APP = {

            _textArea: document.querySelector('#contribution'),
            _contribInfo: document.querySelector('#newContrib__info'),
            _submit: document.querySelector('#btn_submit'),
            _contribError: document.querySelector('.error__contribution'),
            _btnDraft: document.querySelector('#saveDraft'),

            init: () => {
                console.log('init');
                APP.handlers();
                APP.getDraft();
            },

            handlers: () => {
                APP._btnDraft.addEventListener('click', APP.saveDraft);
                APP._submit.addEventListener('click', APP.removeDraft);
                window.addEventListener('input', APP.charContrib)
                console.log('handlers');
            },


            saveDraft: () => {
                draft = APP._textArea.value
                localStorage.setItem('draft', draft);
                console.log(draft);
            },

            getDraft: () => {
                draft = localStorage.getItem('draft');
                APP._textArea.value = draft;
            },

            removeDraft: () => {
                localStorage.removeItem('draft');
            },

            charContrib: () => {
                const nb_char = APP._textArea.value.length;
                APP._contribInfo.innerHTML = "Vous avez " + nb_char + " caractères. Vous devez avoir entre 50 et 280 caractères.";
                  // Taille minimum : 50
                if (nb_char < 50) {
                  APP._contribError.innerHTML ="La contribution minimum est de 50 caractères. Vous avez " + nb_char + " caractères.";
                  APP._submit.disabled = true;
                }
                // Taille maximum : 280
                else if (nb_char > 280) {
                  APP._contribError.innerHTML = "La contribution maximum est de 280 caractères. Vous avez " + nb_char + " caractères.";
                  APP._submit.disabled = true;
                } else {
                  APP._submit.disabled = false;
                  APP._contribError.innerHTML = "";
                }
              }

        };
    window.addEventListener('DOMContentLoaded', APP.init);
})();