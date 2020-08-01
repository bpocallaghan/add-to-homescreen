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
        $.extend(vars, options);

        vars.a2hBox = document.getElementById('a2h-box');

        initialize();
    };

    // initialize - check if we must register
    let initialize = function () {

        // if element not added to dom
        if (typeof (vars.a2hBox) == 'undefined' || vars.a2hBox == null) {
            return;
        }

        // user cancelled app install - do not ask again until cookie expires
        if (getCookie(vars.cookieName) === vars.cookieValue) {
            // vars.a2hBox.style.display = 'none';
            vars.a2hBox.parentNode.removeChild(vars.a2hBox);
            return;
        }

        // if in standalone - do not register
        if (!navigator.standalone) {
            registerServiceWorker();
        }

        // debug / local environment
        // activateAndShowInstallBanner();
    }

    // register service worker
    let registerServiceWorker = function () {
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/serviceworker.js').then(function (registration) {
                    // registration successful
                    activateAndShowInstallBanner();
                }, function (err) {
                    // registration failed :(
                });
            });
        }
    }

    // activate
    let activateAndShowInstallBanner = function () {
        if (!!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform)) {
            vars.a2hBox.style.display = 'block';
            document.querySelector('.platform-android').style.display = "none";
        } else {
            document.querySelector('.platform-ios').style.display = "none";
        }

        // listen for the before installprompt - when pwa can be installed to this device
        window.addEventListener('beforeinstallprompt', function (e) {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            deferredPrompt = e;
            vars.a2hBox.style.display = 'block';

            document.getElementById('btn-accept').addEventListener('click', acceptHomeScreen);
        });

        document.getElementById('btn-reject').addEventListener('click', rejectHomeScreen);
    }

    // on accept home click
    let acceptHomeScreen = function () {
        vars.a2hBox.style.display = 'none';

        deferredPrompt.prompt();
        deferredPrompt.userChoice.then(choiceResult, function () {
            if (choiceResult.outcome === 'accepted') {
                UTILS.doAjax("/api/a2h/installed");
                vars.a2hBox.style.display = 'none';
            } else {
                rejectHomeScreen();
            }
            deferredPrompt = null;
        });
    }

    let rejectHomeScreen = function () {
        vars.a2hBox.style.display = 'none';

        UTILS.doAjax("/api/a2h/cancelled");
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