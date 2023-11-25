(
    function(){
        const App = {

            //const
            _footer: document.querySelector('.footer'),
            _accessContainer: document.querySelector('.access'),
            _accessIcon: document.querySelector('.access__icon'),
            _accessDys: document.querySelector('.access__dys'),
            _accessIncrease: document.querySelector('.access__increase'),
            _accessDecrease: document.querySelector('.access__decrease'),
            _accessShadow: document.querySelector('.access__shadow'),
            _textElements: document.querySelectorAll('p, span, input, label, h1, h2, button, a, li, textarea'),
            _fontSizeComparison: document.querySelector('.navbar__title'),
            _accessButtons: document.querySelectorAll('.footer__button'),
            _buttonAccessVal: false,

            //init
            app_init: function () {
                App.app_handlers();
            },

            //gestionnaire d'ev
            app_handlers: function () {
                App._accessIcon.addEventListener("keydown", App.tabNav);
                App._accessIcon.addEventListener("click", App.toggleAccessContent);
                App._accessDys.addEventListener("click", App.toggleDyslexic);
                App._accessIncrease.addEventListener("click", App.fontSizeIncrease);
                App._accessDecrease.addEventListener("click", App.fontSizeDecrease);
            },

            //ouvre le menu d'accessibilité
            toggleAccessContent: () => {
                App._accessContainer.classList.toggle('access__display');
                App._accessShadow.classList.toggle('access__shadow__display');
                App._accessButtons.forEach( button =>{
                    button.classList.toggle('footer__button__display');
                });
            },

            //change la police en police dyslexique friendly
            toggleDyslexic: () => {
                App._textElements.forEach(elm => {
                    elm.classList.toggle('dys');
                })
            },

            //augmente la taille des polices jusqu'à 6px
            fontSizeIncrease: () => {                
                let refSize = parseFloat(window.getComputedStyle(App._fontSizeComparison, null).getPropertyValue('font-size'));
                let currentVal = 0;
                if(refSize < "16"){
                App._accessIncrease.classList.remove('access__disabled');
                App._accessDecrease.classList.remove('access__disabled');
                App._textElements.forEach(elm =>{
                    if (elm.classList.contains('access__dys')) {
                    }else{
                        currentVal = parseFloat(window.getComputedStyle(elm, null).getPropertyValue('font-size'));                        
                        elm.style = "font-size: " + ( currentVal+ 1) + "px";
                    }
                })
                }else if(refSize >= "16"){
                    App._accessIncrease.classList.add('access__disabled');
                }              
            },

            //réduit la taille des polices jusqu'à 4px
            fontSizeDecrease: () => {                
                let refSize = parseFloat(window.getComputedStyle(App._fontSizeComparison, null).getPropertyValue('font-size'));
                let currentVal = 0;
                if(refSize > "8"){
                App._accessDecrease.classList.remove('access__disabled');
                App._accessIncrease.classList.remove('access__disabled');
                App._textElements.forEach(elm =>{
                    if (elm.classList.contains('access__dys')) {
                    }else{
                        currentVal = parseFloat(window.getComputedStyle(elm, null).getPropertyValue('font-size'));                        
                        elm.style = "font-size: " + ( currentVal- 1) + "px";
                    }
                })
                }else if(refSize <= "8"){
                    App._accessDecrease.classList.add('access__disabled');
                }              
            },

            tabNav: (e) => {
                if ( e.key === 'Enter') {
                    App._buttonAccessVal = !App._buttonAccessVal;
                    if(App._buttonAccessVal){
                        App.toggleAccessContent();
                        App._accessDys.setAttribute('tabindex', '0');
                        App._accessDecrease.setAttribute('tabindex', '0');
                        App._accessIncrease.setAttribute('tabindex', '0');
                    } else {
                        App.toggleAccessContent();
                        App._accessDys.setAttribute('tabindex', '-1');
                        App._accessDecrease.setAttribute('tabindex', '-1');
                        App._accessIncrease.setAttribute('tabindex', '-1');
                    }
                }
            }
            
        };

    window.addEventListener('DOMContentLoaded', App.app_init());
    })();