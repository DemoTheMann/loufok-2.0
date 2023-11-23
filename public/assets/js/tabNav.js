(
    function(){
        const App = {

            //const
            _burger: document.querySelector('.navbar__cross'),
            _menu: document.querySelector('.navbar__burger'),
            _menuTabNav: document.querySelectorAll('.menu__hidden__listItem a'),
            _allTabNav: document.querySelectorAll('input, textarea, button'),

            //init
            app_init: function () {
                App.app_handlers();
            },

            //gestionnaire d'ev
            app_handlers: function () {
                App._burger.addEventListener("keydown", App.toggleMenu);
            },

            //déroule le menu à la touche "entrée"
            //permet la navigation au tab
           toggleMenu: (e) =>{
                    if (e.key === 'Enter') {
                        App._menu.checked = !App._menu.checked;

                        console.log("App._menu.checked:", App._menu.checked);
                        if(App._menu.checked){
                            App._allTabNav.forEach(elm => {
                                elm.setAttribute('tabindex', '-1');
                            })
                            App._menuTabNav.forEach(menuElm => {
                                menuElm.setAttribute('tabindex', '0');
                            });
                        }else{
                            App._allTabNav.forEach(elm => {
                                elm.setAttribute('tabindex', '0');
                            })
                            App._menuTabNav.forEach(menuElm => {
                                menuElm.setAttribute('tabindex', '-1');
                            });
                        }
                    }
            },
        };

  /*       giveTabElements: (toggleElement, interactiveElements) => {
            if(toggleELement.checked){
                App._allTabNav.forEach(elm => {
                    elm.setAttribute('tabindex', '-1');
                })
                App._menuTabNav.forEach(menuElm => {
                    menuElm.setAttribute('tabindex', '0');
                });
            }else{
                App._allTabNav.forEach(elm => {
                    elm.setAttribute('tabindex', '0');
                })
                App._menuTabNav.forEach(menuElm => {
                    menuElm.setAttribute('tabindex', '-1');
                });
            }
        }, */

    window.addEventListener('DOMContentLoaded', App.app_init());
    })();