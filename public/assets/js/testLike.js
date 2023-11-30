(
    function(){
        const APP = {

            // Const
            _button : document.querySelector('#like'),

            //init
            init: function () {
                console.log('init');
                APP.handlers();
            },

            //gestionnaire d'ev
            handlers: function () {
                console.log('handlers');
                APP._button.addEventListener('click',APP.addLike);
            },

            addLike: () => {

                idCadavre = APP._button.dataset.cadavre;
                // console.log(idCadavre);
                fetch(`http://localhost:8080/API/cadavres/${idCadavre}/like`, {
                    method: "POST",
                })
                .then(Response =>{
                    console.log(Response);
                })
                
            }
        }

    window.addEventListener('DOMContentLoaded', APP.init());
    })();