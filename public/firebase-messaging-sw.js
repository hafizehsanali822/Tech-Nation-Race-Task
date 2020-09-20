/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
  

   apiKey: "AIzaSyDdC6kyUsXqpFvQnQxg0BHWprBbmiu6NMU",
    authDomain: "race-push-notification.firebaseapp.com",
    databaseURL: "https://race-push-notification.firebaseio.com",
    projectId: "race-push-notification",
    storageBucket: "race-push-notification.appspot.com",
    messagingSenderId: "115561966183",
    appId: "1:115561966183:web:baa6c93846312e949f82c2",
    measurementId: "G-S85YCZE5TL"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});