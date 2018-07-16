$(document).ready(function () {

    $("#form-register").submit(function(e) {

        var url = "api/auth/register"; 
        $('#error-register-email').html('');
        $('#error-register-password').html('');
        $.ajax({
            type: "POST",
            url: url,
            data: $("#form-register").serialize(), 
            success: function(data)
            {
                $(location).attr('href', '/login');
            },
            error: function(err){
                console.log(err);
                Object.keys(err.responseJSON.msg).map(item=>{
                    $('#error-register-'+item).html(err.responseJSON.msg[item][0]);
                })
            }
            });
        e.preventDefault(); 
    });


    
});