$(document).ready(function () {

    $("#form-login").submit(function(e) {
        var url = "api/auth/login"; 
        $.ajax({
            type: "POST",
            url: url,
            data: $("#form-login").serialize(), 
            success: function(data)
            {
                localStorage.setItem('token',data.data.token)
                $(location).attr('href', '/');
            },
            error: function(err){
                console.log(err.responseJSON.errors.email[0]);
                $('#error-login').html(err.responseJSON.errors.email);
            }
            });
        e.preventDefault(); 
    });
    
});