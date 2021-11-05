"use strict";
var path = window.location.pathname;
(function (pathname) {
    var possiblePaths = ['home', 'packages', 'services', 'register', 'login'];
    var incomingPath = path.split("/")[path.split('/').length - 1];
    console.log(incomingPath);
})(path);
