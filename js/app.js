$(document).ready(function() {

    $("button.delete").on('click', function(e){
        e.preventDefault();
        if ( ! confirm('Are you sure?')) {
            return false;
        }
        var action = $(this).data("action");
        var parent = $(this).parent();
        var token  = $(this).data("token");

        //Ajax Method For Deletion
        $.ajax({
            type: 'POST',
            url: action,
            data: { _token: token, _method: 'delete' },
            error: function(msg) {
                alert(msg.responseJSON[0]);
            },
            success: function(data) {

                if(data.redirect){
                    window.location.href = data.redirect;
                } else{
                    parent.next().fadeOut(1000).remove();
                    parent.fadeOut(1000).remove();
                }

            }
        });

    });

    setTimeout(function() {
        $('.alert').fadeOut(1000);
        $('.alert').remove();
    }, 1000);

});