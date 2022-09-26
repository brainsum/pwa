if (firebase.messaging.isSupported())
  console.log('supported browser');
else
  alert('unsupported browser');

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyAp9BhN4McN0gg5MQ-J7n2CaMXeF810Oqs",
  authDomain: "push-notifications-drupal.firebaseapp.com",
  projectId: "push-notifications-drupal",
  storageBucket: "push-notifications-drupal.appspot.com",
  messagingSenderId: "243493653558",
  appId: "1:243493653558:web:11ca6855d779cb62489c97",
  measurementId: "G-R9JDVYJSJ8"
};


// Initialize Firebase
const app = firebase.initializeApp(firebaseConfig);


// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = firebase.messaging(app);

messaging.getToken({ vapidKey: 'BJ8qQTryup6E-VFQ37c_72cy7iebqTmWTysdCitXBh0XKQiwDsbP8hyswl-RQ-czXjCNre9kgkTsEHIuOvSClgg' });

messaging.getToken()
.then(function (currentToken) {
  if (currentToken) {
    var t = document.getElementById('mytoken');
    t.innerHTML = currentToken;
  }
  else {
    alert('No permission');
  }
})
.catch(function (err) {
  alert('Token Error ' + err);
});
