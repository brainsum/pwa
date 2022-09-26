importScripts('https://www.gstatic.com/firebasejs/9.10.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.10.0/firebase-messaging-compat.js');

const firebaseConfig = {
  apiKey: "AIzaSyAp9BhN4McN0gg5MQ-J7n2CaMXeF810Oqs",
  authDomain: "push-notifications-drupal.firebaseapp.com",
  projectId: "push-notifications-drupal",
  storageBucket: "push-notifications-drupal.appspot.com",
  messagingSenderId: "243493653558",
  appId: "1:243493653558:web:11ca6855d779cb62489c97",
  measurementId: "G-R9JDVYJSJ8"
};

firebase.initializeApp(firebaseConfig);
//firebase.initializeApp({
//  "messagingSenderId": "243493653558",
//});

const messaging = firebase.messaging();
