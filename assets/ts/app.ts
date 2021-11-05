const path: string = window.location.pathname;
    
    
    
    
(function (pathname: string) {
    const possiblePaths: Array<string> = ['home', 'packages', 'services', 'register', 'login']
    const incomingPath: string = path.split("/")[path.split('/').length - 1]
    console.log(incomingPath)
})(path);
