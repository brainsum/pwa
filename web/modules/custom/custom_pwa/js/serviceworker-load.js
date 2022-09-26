(function (Drupal, drupalSettings, navigator, window) {
  'use strict';

  let swfileUrl = drupalSettings.custom_pwa.installPath;

  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
      navigator.serviceWorker.register(swfileUrl, {
        scope: drupalSettings.path.baseUrl
      }).then(function (registration) {
        console.log("Service Worker registered! Scope: ".concat(registration.scope));
      }).catch(function (err) {
        console.log("Service Worker registration failed: ".concat(err));
      });
    });
  }

})(Drupal, drupalSettings, navigator, window);
