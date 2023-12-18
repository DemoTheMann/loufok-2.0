(
    function(){
        const APP = {

            _pwaInstallButton: document.getElementById("installPWA"),
            

            init: () => {
                console.log('init');
                APP._pwaInstallButton.removeAttribute("hidden");
                APP.showForChrome;

                APP.handlers;
            },

            handlers: () => {
                console.log('handlers');

                window.addEventListener('beforeInstallprompt', APP.notInstalled);
                if(!installPrompt){
                    APP.installed;
                }
            },


            showForChrome: () => {
                if (!window.navigator.userAgent.includes("Chrome")) {
                    APP._pwaInstallButton.setAttribute("hidden", "");
                }
            },

            notInstalled: (event) => {
                event.preventDefault();
                installPrompt = event;
                pwaInstallButton.classList.remove("d-none");
            },

            installed: async() => {
                result = await installPrompt.prompt();
                installPrompt = null;
                pwaInstallButton.setAttribute("hidden", "");
            },


        };
        window.addEventListener('DOMContentLoaded',APP.init);
})();


// let installPrompt;

//     if (!window.navigator.userAgent.includes("Chrome")) {
//       pwaInstallButton.setAttribute("hidden", "");
//     }

//     if (pwaInstallButton) {
//       window.addEventListener("beforeinstallprompt", (event) => {
//         event.preventDefault();
//         installPrompt = event;
//         pwaInstallButton.classList.remove("d-none");
//       });
//     }

//     pwaInstallButton.addEventListener("click", async()=>{
//       if(!installPrompt) return;

//       const result = await installPrompt.prompt();

//       installPrompt = null;
//       pwaInstallButton.setAttribute("hidden", "");
//     })