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

            //init
            app_init: function () {
                App.app_handlers();
            },

            //gestionnaire d'ev
            app_handlers: function () {
                App._accessIcon.addEventListener("click", App.toggleAccessContent);
                App._accessDys.addEventListener("click", App.toggleDyslexic);
                App._accessIncrease.addEventListener("click", App.fontSizeIncrease);
                App._accessDecrease.addEventListener("click", App.fontSizeDecrease);
            },

            //ouvre le menu d'accessibilité
            toggleAccessContent: () => {
                App._accessContainer.classList.toggle('access__display');
                App._accessShadow.classList.toggle('access__shadow__display');
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
                console.log(refSize);
                if(refSize < "17"){
                App._accessIncrease.classList.remove('access__disabled');
                App._accessDecrease.classList.remove('access__disabled');
                App._textElements.forEach(elm =>{
                    if (elm.classList.contains('access__dys')) {
                    }else{
                        currentVal = parseFloat(window.getComputedStyle(elm, null).getPropertyValue('font-size'));                        
                        elm.style = "font-size: " + ( currentVal+ 1) + "px";
                    }
                })
                }else if(refSize >= "17"){
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
            
        };

    window.addEventListener('DOMContentLoaded', App.app_init());
    })();