"use strict";
var path = window.location.pathname;
(function () {
    var title = "Usalvagetrade | Premiere plateforme de trading en afrique";
    var possiblePaths = ['home', 'packages', 'services', 'register', 'login'];
    var incomingPath = path.split("/")[path.split('/').length - 1];
    if (possiblePaths.indexOf(incomingPath) !== -1) {
        switch (incomingPath) {
            case "home":
                title = "Usalvagetrade | Premiere plateforme de trading en afrique";
                break;
            case "packages":
                title =
                    "Nos packs | Usalvagetrade";
                break;
        }
    }
    else {
        title = "404 - Page not found";
    }
    window.document.title = title;
})();
