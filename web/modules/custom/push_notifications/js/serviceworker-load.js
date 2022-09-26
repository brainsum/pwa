"use strict";

(function (Drupal, drupalSettings, navigator, window) {
  'use strict';

  let swfileUrl = drupalSettings.push_notifications.installPath;
  var enableNotificationsButtons = document.querySelectorAll('.enable-notifications');

  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
      //console.log(drupalSettings.push_notifications.installPath);
      navigator.serviceWorker.register(swfileUrl, {
        scope: drupalSettings.path.baseUrl
      }).then(function (registration) {
        console.log("Service Worker registered! Scope: ".concat(registration.scope));
      }).catch(function (err) {
        console.log("Service Worker registration failed: ".concat(err));
      });
    });
  }

  function displayConfirmNotification() {
    if ('serviceWorker' in navigator) {
      var options = {
        body: 'Successfully subscribed to our notification service!',
        icon: '/modules/contrib/pwa/assets/druplicon-192.png',
        image: 'http://127.0.0.1:49157/modules/contrib/pwa/assets/druplicon-512.png',
        //dir: 'ltr',
        //lang: 'en-US',
        //vibrate: [100, 50, 200],
        //badge: '/modules/contrib/pwa/assets/druplicon-192.png',
        //tag: 'confirm-notification',
        //renotify: true
        //action: [
        //  { action: 'confirm', title: 'Okay', icon: '/modules/contrib/pwa/assets/druplicon-192.png' },
        //  { action: 'cancel', title: 'Cancel', icon: '/modules/contrib/pwa/assets/druplicon-192.png' },
        //]
      };

      navigator.serviceWorker.ready
        .then(function(swreg) {
          swreg.showNotification('Successfully subscribed (from SW)', options);
        });
    }

    /*
    var options = {
      body: 'Successfully subscribed to our notification service!'
    };
    new Notification('Successfully subscribed!', options);
    */
  }

  function askForNotificationPermission() {
    Notification.requestPermission(function (result) {
      if (result !== 'granted') {
        console.log('No notification permission granted!');
      } else {
        console.log('Notification permission granted.');
        displayConfirmNotification();
      }
    });
  }

  if ('Notification' in window) {
    for (var i = 0; i < enableNotificationsButtons.length; i++) {
      enableNotificationsButtons[i].addEventListener('click', askForNotificationPermission);
    }
  }

})(Drupal, drupalSettings, navigator, window);
