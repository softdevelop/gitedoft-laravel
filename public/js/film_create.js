$(document).ready(function () {

    $("#film-create-ajax").submit(function(e) {
        e.preventDefault(); 
        console.log( ($("#film-create-ajax").serialize()));
        var url = "/api/films"; 
        var name = $('#film-create-ajax').find('input[name="name"]').val();
        var description = $('#film-create-ajax').find('input[name="description"]').val();
        var realease_date = $('#film-create-ajax').find('input[name="realease_date"]').val();
        var rating = $('#film-create-ajax').find('input[name="rating"]').val();
        var ticket_price = $('#film-create-ajax').find('input[name="ticket_price"]').val();
        var country = $('#film-create-ajax').find('input[name="country"]').val();
        var genre = $('#film-create-ajax').find('input[name="genre"]').val();
        var photo = $('#film-create-ajax').find('input[name="photo"]').val();
        console.log({url,
            name,
            description,
            realease_date,
            rating,
            ticket_price,
            country,
            genre,
            photo,
        })
        $('#error-create-name').html('');
        $('#error-create-description').html('');
        $('#error-create-realease_date').html('');
        $('#error-create-rating').html('');
        $('#error-create-ticket_price').html('');
        $('#error-create-genre').html('');
        $('#error-create-country').html('');

        var formData = new FormData( $(this) );
        console.log(formData);
        $.ajax({
            type: "POST",
            url: url,
            data: $("#film-create-ajax").serialize(), 
            success: function(data)
            {
                console.log(data);
            },
            error:function(err){

                console.log(err)
                Object.keys(err.responseJSON.msg).map(item=>{
                    $('#error-create-'+item).html(err.responseJSON.msg[item][0]);
                })
            }
            });
        e.preventDefault();
    });
    function base64ToBlob(base64, mime) 
    {
        mime = mime || '';
        var sliceSize = 1024;
        var byteChars = window.atob(base64);
        var byteArrays = [];

        for (var offset = 0, len = byteChars.length; offset < len; offset += sliceSize) {
            var slice = byteChars.slice(offset, offset + sliceSize);
            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }
        return new Blob(byteArrays, {type: mime});
    }

    function getBase64(file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            console.log(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }
});