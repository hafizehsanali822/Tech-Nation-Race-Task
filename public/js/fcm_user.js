
   
        $(document).ready(function(){
            const config = {
                apiKey: "AIzaSyDdC6kyUsXqpFvQnQxg0BHWprBbmiu6NMU",
                authDomain: "race-push-notification.firebaseapp.com",
                databaseURL: "https://race-push-notification.firebaseio.com",
                projectId: "race-push-notification",
                storageBucket: "race-push-notification.appspot.com",
                messagingSenderId: "115561966183",
                appId: "1:115561966183:web:baa6c93846312e949f82c2",
                measurementId: "G-S85YCZE5TL"
            };
            firebase.initializeApp(config);
            const messaging = firebase.messaging();
            
            messaging.requestPermission()
                      .then(function () {
                    return messaging.getToken()
                })
                
                .then(function(token) {
                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });
                   // alert('fcm : ' +token)
                    $.ajax({
                        url: $('meta[name="store_fcmtoken_url"]').attr('content'),
                        type: 'POST',
                        data: {
                            user_id: $('meta[name="user_id"]').attr('content'),
                            fcm_token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                          //  console.log(response)
                        },
                        error: function (err) {
                            console.log(" Can't do because: " + JSON.stringify(err));
                           // console.log(" Can't do because: " + err);
                        },
                    });
                })
                .catch(function (err) {
                    console.log("Unable to get permission to notify.", err);
                });
        
            messaging.onMessage(function(payload) {
                const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
                console.log(noteOptions );
            });
        });

