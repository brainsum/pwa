var pushRequestPermissionButtons = document.querySelectorAll('.push-permission-request');

function displayConfirmNotification() {
  if ('serviceWorker' in navigator) {
    var options = {
      body: 'Successfully subscribed to our notification service!',
      icon: window.location.origin + '/modules/custom/custom_pwa/assets/icons/icon-48x48.png',
      // image: window.location.origin + '/modules/custom/custom_pwa/assets/icons/icon-192x192.png',
      //dir: 'ltr',
      //lang: 'en-US',
      //vibrate: [100, 50, 200],
      //badge: '/modules/custom/custom_pwa/assets/icons/icon-96x96.png',
      //tag: 'confirm-notification',
      //renotify: true
      //action: [
      //  { action: 'confirm', title: 'Okay', icon: '/modules/custom/custom_pwa/assets/icons/icon-96x96.png' },
      //  { action: 'cancel', title: 'Cancel', icon: '/modules/custom/custom_pwa/assets/icons/icon-96x96.png' },
      //]
    };

    navigator.serviceWorker.ready
      .then(function (swreg) {
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
  for (var i = 0; i < pushRequestPermissionButtons.length; i++) {
    pushRequestPermissionButtons[i].addEventListener('click', askForNotificationPermission);
  }
}
