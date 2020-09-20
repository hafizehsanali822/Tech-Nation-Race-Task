
$('.nav-btn-links').click(function(event){
    event.preventDefault();
    var actionUrl = $(this).attr('href');
    var apiToken =  $('[name=api-token]').attr('content');
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
});

$('form').submit(function( event ) {
    event.preventDefault();
    var actionUrl = $(this).attr('action');
    var formData = $(this).serialize();
    MakeApiCall('POST', actionUrl, '{}', formData)
});  

function MakeApiCall(method, actionUrl,  apiToken, postData)
{
    $.ajax({
            url: actionUrl,
            type: method,
            headers: {  'Authorization': 'Bearer ' + apiToken },
            data: postData,//{ email:'danish@email.com', password: '123456'},
            dataType: 'JSON',
            success: function (response) {
                var response = response.success
                    _token = response.token
                //console.log(response)
                $('#app').html(response.html);
                var apiToken =  response.token;
                if( response.token != undefined)
                {
                    $('meta[name="api-token"]').attr("content", apiToken);
                 }
                 if( response.user != undefined)
                 {
                    $('meta[name="user_id"]').attr("content",response.user.id );
                 }
                 if(response.message != undefined)
                 {
                    $('#top-success-message').attr("hidden", false)
                    $('#top-success-message > span').text(response.message);
                 }
                 
            },
            error: function (err) {
                //console.log(" Can't do because: " + JSON.stringify(err));
                var erroMessager = JSON.parse(err.responseText)
                var erroMessager = erroMessager.error_message
                console.log(erroMessager);

                if(erroMessager != undefined && erroMessager.length != 0)
                {   
                    var messageHtml= '<ul>';
                    Object.keys(erroMessager).forEach(key => {  messageHtml += '<li>'+erroMessager[key]+'</li>'  });
                    messageHtml += '</ul>';
                    $('#top-error-message').empty();
                    $('#top-error-message').append(messageHtml);
                    $('#top-error-message').attr("hidden", false)
                 }

             }
        });

}

function joinDisJoinRace(raceId, apiurl)
{
   
    var apiToken =  $('[name=api-token]').attr('content');
     $.ajax({
        url: apiurl,
        headers: {  'Authorization': 'Bearer ' + apiToken },
        type: 'POST',
        data: { race_id: raceId},
        dataType: 'JSON',
        success: function (response) {
              var response = response.success
              //console.log(response)
              $('#app').html(response.html);
              if(response.message != undefined)
                 {
                    $('#top-success-message').attr("hidden", false)
                    $('#top-success-message > span').text(response.message);
                 }
        },
        error: function (err) {
           console.log(" Can't do because: " + JSON.stringify(err));
        },
    });
}