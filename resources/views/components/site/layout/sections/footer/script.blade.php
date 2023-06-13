<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('submit', '#footer-contact', function (e) {
            e.preventDefault();

            let url    = $(this).attr('action');
            let method = $(this).attr('method');
            let data   = $(this).serialize();
            var items  = $(this).serializeArray();

            $.each(items, function(index, item) {

                $('#error-contact-' + item.name).removeClass('is-invalid');
                $('#error-contact-' + item.name).css('border', '1px solid #E3E3E3');
                $('#error-contact-' + item.name + '-message').text('');

            }); //end of each

            $.ajax({
                url: url,
                data: data,
                method: method,
                success: function (data) {

                    swal({
                        title: 'success',
                        type: "success",
                        icon: 'success',
                        buttons: false,
                        timer: 1000
                    }); //end of swal

                    location.reload();
                    
                },
                error: function(data) {

                    $.each(data.responseJSON.errors, function(name, message) {

                        $('#error-contact-' + name).addClass('is-invalid');
                        $('#error-contact-' + name).css('border', '1px solid red');
                        $('#error-contact-' + name + '-message').text(message);

                    }); //end of each

                }, //end of success
                
            });//end of ajax

        });//end of submit register

    });//end of document ready
</script>