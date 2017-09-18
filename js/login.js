$(document).ready(
    function() {
        $('#login-form').on('submit',onLogin);
    }
);

function onLogin(submitevent) {
    submitevent.preventDefault();
    $('.alert').remove();
    $('button[type="submit"]').attr("disabled","");
    //get data from target form
    let formdata = new FormData(submitevent.target);
    //create login data to send to server
    let logindata = {
        user: formdata.get('user'),
        pass: formdata.get('pass')
    };
    $.ajax({
        type: 'post',
        url: 'ajax/ajaxlogin.php',
        data: logindata,
        dataType: 'json',
        encode: true
    })
    .done( function(response) {
        console.log(response);
        if(response.success == true) {
            //login is successful
            //create alert success
            displayAlert("success","login successful");
            
            window.setTimeout(function(){window.location.href="account.php"},2000);
        }
        else {
            //login is unsuccessful
            displayAlert("warning","login unsuccessful");
            $('button[type="submit"]').removeAttr("disabled");
        }
    });
}

function displayAlert(type,message) {
    let template = $('#login-template').html().trim();
    let clone = $(template);
    //add message
    $(clone).find('.message').text(message);
    
    if(type == 'success') {
        $(clone).addClass('alert-success');    
    }
    else {
        $(clone).addClass('alert-warning');
    }
    $('#login-form').append(clone);
}