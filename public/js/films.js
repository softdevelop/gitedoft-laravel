$( document ).ready(function() {

    console.log('ahihi');
    films='';
    url = 'api/films';
    $.ajax({
        url: url,
        success: function (data) {
            console.log(data.data.films);
            data.data.films.map(item=>{
                console.log(item.photo.includes('://'));
                link = '';
                if (item.photo.includes('://'))
                link = '<img src="'+item.photo+'" alt="">';
                else link = '<img src="'+window.location.origin+'/storage/'+item.photo+'" />';
                console.log(link)

                films += '<div class="col-md-4 col-sm-12 mb-5">'+
                    '<div class="card">'+
                        '<div class="card-header name-film">'+item.name+'</div>'+
    
                        '<div class="card-body">'+
                            '<div class="form-group row-img">'+
                            link+
                            '</div>'+
                            '<div class="form-group row-content text-center text-center">'+
                                '<a href="films/'+item.slug+'" class="center">View</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            });
            $('#films').html(films);
        }
    });
});