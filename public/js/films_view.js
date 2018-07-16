$( document ).ready(function() {
    film='';
    comments='';
    url = 'api/films';
    $.ajax({
        url: '/api'+window.location.pathname,
        success: function (data) {
            console.log(data.data.film);
            item = data.data.film;
            genre = item.genre.split('"');
            if(genre.length>1) 
            genre =genre.filter(item=>{
                if (item == ',' || item == '[' || item == ']') return false;
                return true;
            });
            item.comments.map(item => {
                comments +=
                    '<b>'+item.name+': </b>'+item.content+'</br>';
            })

            link = '';
            if (item.photo.includes('://'))
            link = '<img src="'+item.photo+'" alt="">';
            else link = '<img src="'+window.location.origin+'/storage/'+item.photo+'" />';
            console.log(link)

            film += 
            '<div class="card">'+
            '<div class="card-header">'+item.name+'</div>'+
            '<div class="card-body clearfix">'+
                '<div class="form-group row-film-view clearfix">'+
                    '<div class="content-left">'+
                    link+
                    '</div>'+
                   '<div class="content-right">'+
                       '<div class="form-group row-content pt-5">'+
                            '<p><b>Name: </b>'+item.name+'</p>'+
                            '<p><b>Realease date: </b>'+item.realease_date+'</p>'+
                            '<p><b>Rating: </b>'+item.rating+'</p>'+
                            '<p><b>Ticket: </b>'+item.ticket_price+'</p>'+
                            '<p><b>Country: </b>'+item.country+'</p>'+
                            '<p><b>Genre: </b>'+genre.join(', ')+'</p>'+
                            '<p><b>Description: </b>'+item.description+'</p>'+
                        '</div>'+
                   '</div>'+
                '</div>'+
                '<hr>'+
                '<div class="form-group row-film-view clearfix">'+
                    '<h3>Comments</h3>'+
                    '<hr>'+
                    comments
                '</div>'+
            '</div>'+
        '</div>';

        $('#films-view').html(film);

        }
    });

    $("#form-comment-film").submit(function(e) {

        var url = "/login";

        $.ajax({
            type: "POST",
            url: url,
            data: $("#form-login").serialize(),
            success: function(data)
            {
                console.log(data);
                $(location).attr('href', '/');
            },
            error: function(err){
                console.log(err.responseJSON.errors.email[0]);
                $('#error-login').html(err.responseJSON.errors.email);
            }
            });
            // 
        e.preventDefault(); 
    });

});