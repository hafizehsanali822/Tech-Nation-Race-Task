
$('.nav-btn-links').click(function(event){
    event.preventDefault();
    var actionUrl = $(this).attr('href');
    var apiToken =  $('[name=api-token]').attr('content');
    //alert(apiToken)
    var raceId = $(this).attr("data-raceid");
    

    if(apiToken!=  undefined &&  raceId == undefined)
    {
        header = "  'Authorization': 'Bearer '" + apiToken 
        MakeApiCall('GET', actionUrl, apiToken)
    }else if(raceId == undefined){
            MakeApiCall('GET', actionUrl)
        } 

    
    if( raceId != undefined  && apiToken!= undefined)
    {
        var postdata = '{ race_id : ' + raceId + '}';
       // MakeApiCall('POST', actionUrl, apiToken, postdata);
        joinDisJoinRace(raceId, actionUrl)
    }
    //alert(actionUrl+'-' +raceId );
});

$('form').submit(function( event ) {
    event.preventDefault();
    var actionUrl = $(this).attr('action');
    var formData = $(this).serialize();
    MakeApiCall('POST', actionUrl, '{}', formData)
    //alert(actionUrl)
});  

function MakeApiCall(method, actionUrl,  apiToken, postData)
{
    // alert(actionUrl)
    // alert(method)
    // alert(postData)
    // alert(call_header)
    $.ajax({
            url: actionUrl,
            type: method,
            headers: {  'Authorization': 'Bearer ' + apiToken },
            data: postData,//{ email:'danish@email.com', password: '123456'},
            dataType: 'JSON',
            success: function (response) {
                var response = response.success
                    _token = response.token
                console.log(response)
                $('#app').html(response.html);
                var apiToken =  response.token;
                if( response.token != undefined)
                {
                    $('meta[name="api-token"]').attr("content", apiToken);
                   // alert(apiToken);
                 }
                 if( response.user != undefined)
                 {
                     //alert(response.user.id)
                    $('meta[name="user_id"]').attr("content",response.user.id );
                 }
            },
            error: function (err) {
             console.log(" Can't do because: " + JSON.stringify(err));
            // var erroMessager = JSON.parse(err.responseText)
            // var erroMessager = erroMessager.error_message
            // $('#top-error-message').attr("hidden", false)
            // $('#top-error-message > span').text(erroMessager);
            //     console.log(" Can't do because: " +  erroMessager);
             }
        });

}

function joinDisJoinRace(raceId, apiurl)
{
   
    var apiToken =  $('[name=api-token]').attr('content');
    // alert(apiurl)
    // alert(raceId)
    // alert(apiToken)

     $.ajax({
        url: apiurl,
        headers: {  'Authorization': 'Bearer ' + apiToken },
        type: 'POST',
        data: { race_id: raceId},
        dataType: 'JSON',
        success: function (response) {
              var response = response.success
              console.log(response)
              $('#app').html(response.html);
        },
        error: function (err) {
           console.log(" Can't do because: " + JSON.stringify(err));
        },
    });
}