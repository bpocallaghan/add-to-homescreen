let A2HClass = function (options) {
    let vars = {
        a2hBox: 'a2h-box',
        cookieName: 'a2h',
        cookieValue: 'ignore',
        platformIos: 'platform-ios',
        platformAndroid: 'platform-android',
    };

    let root = this;
    let deferredPrompt = false;

    // construct
    this.construct = function (options) {
        // $.extend(vars, options);

        vars.a2hBox = document.getElementById('a2h-box');

        initialize();
    };

    // initialize - check if we must register
    let initialize = function () {

        // user cancelled app install - do not ask again until cookie expires
        if (getCookie(vars.cookieName) === vars.cookieValue) {
            // vars.a2hBox.style.display = 'none';
            vars.a2hBox.parentNode.removeChild(vars.a2hBox);
            return;
        }

        // if in standalone - do not activate
        if (!navigator.standalone) {
            registerServiceWorker();
        }

        // debug / test locally
        activate();
    }

    // register service worker
    let registerServiceWorker = function () {
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/serviceworker.js').then(function (registration) {
                    // Registration was successful
                    console.log('service worker registered');
                    activate();
                }, function (err) {
                    // registration failed :(
                    console.log('service worker failed');
                });
            });
        }
    }

    let activate = function () {
        if (!!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform)) {
            vars.a2hBox.style.display = 'block';
            document.querySelector('.platform-android').style.display = "none";
        } else {
            document.querySelector('.platform-ios').style.display = "none";
        }

        window.addEventListener('beforeinstallprompt', function (e) {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            deferredPrompt = e;
            vars.a2hBox.style.display = 'block';

            document.getElementById('btn-accept').addEventListener('click', function (e) {
                vars.a2hBox.style.display = 'none';

                deferredPrompt.prompt();
                deferredPrompt.userChoice.then(choiceResult, function () {
                    if (choiceResult.outcome === 'accepted') {
                        // UTILS.doAjax("/api/a2h/installed");
                    } else {
                        rejectHomeScreen();
                    }
                    deferredPrompt = null;
                });
            });
        });

        // on reject click
        document.getElementById('btn-reject').addEventListener('click', function () {
            rejectHomeScreen();
        });
    }

    let rejectHomeScreen = function () {
        vars.a2hBox.style.display = 'none';

        // UTILS.doAjax("/api/a2h/cancelled");
        setCookie(vars.cookieName, vars.cookieValue, 15);
    }

    let setCookie = function (name, value, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    let getCookie = function (cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    this.construct(options);
};