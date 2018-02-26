$(document).ready(function() {

    // process the form
    $('form').submit(function(event) {

        var formData = '';

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'process.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        }).done(function(data) {
            console.log(data); 
            if ( ! data.success) {

            } else {
            	
            }
        });

    });

});