const path: string = window.location.pathname;
    
    
    
    
(function () {
    let title: string =
      "Usalvagetrade | Premiere plateforme de trading en afrique";
    const possiblePaths: Array<string> = ['home', 'packages', 'services', 'register', 'login']
    const incomingPath: string = path.split("/")[path.split('/').length - 1]
    if (possiblePaths.indexOf(incomingPath) !== -1) {
        switch (incomingPath) {
            case "home":
                title = "Usalvagetrade | Premiere plateforme de trading en afrique"
                break;
            case "packages":
                title =
                    "Nos packs | Usalvagetrade";
                break;
                
        }
    } else {
        title = "404 - Page not found"
    }
    window.document.title = title
})();
