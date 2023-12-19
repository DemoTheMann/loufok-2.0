(
    function(){
        const APP = {

            // Const
            _button : document.querySelector('#like'),

            //init
            init: function () {
                APP.handlers();
            },

            //gestionnaire d'ev
            handlers: function () {
                APP._button.addEventListener('click',APP.addLike);
            },

            addLike: () => {

                idCadavre = parseInt(APP._button.dataset.cadavre);
                data = { idCadavre: idCadavre };

                fetch(`https://jbienvenu.alwaysdata.net/loufok/api/cadavre/like`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify(data),
                })
                .then(Response =>{
                    console.log(Response);
                })
                
            }
        }

    window.addEventListener('DOMContentLoaded', APP.init());
    })();
