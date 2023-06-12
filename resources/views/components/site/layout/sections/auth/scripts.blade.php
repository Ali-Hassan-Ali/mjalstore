<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.model-auth', function (e) {
            e.preventDefault();

            let type = $(this).data('type');

            if(type == 'register') {

                $('#login').removeClass('show active');
                $('#login-tab').removeClass('active');

                $('#register').addClass('show active');
                $('#register-tab').addClass('active');

            } else {

                $('#login').addClass('show active');
                $('#login-tab').addClass('active');

                $('#register').removeClass('show active');
                $('#register-tab').removeClass('active');

            }

        });//end of submit login

        $(document).on('submit', '#auth-login', function (e) {
            e.preventDefault();

            let url    = $(this).attr('action');
            let method = $(this).attr('method');
            let data   = $(this).serialize();
            var items  = $(this).serializeArray();

            $.each(items, function(index, item) {

                $('#error-' + item.name).removeClass('is-invalid');
                $('#error-' + item.name).css('border', '1px solid #E3E3E3');
                $('#error-' + item.name).css('background-image', 'url()');
                $('#error-' + item.name + '-message').text('');

            }); //end of each

            $.ajax({
                url: url,
                data: data,
                method: method,
                success: function (data) {

                    if(data.login == true) {
                        
                        swal({
                            title: data.success,
                            type: "success",
                            icon: 'success',
                            buttons: false,
                            timer: 1000
                        }); //end of swal

                        location.reload();
                    }

                    if(data.password) {
                        $('#error-password').addClass('is-invalid');
                        $('#error-password').css('border', '1px solid red');
                        $('#error-password').css('background-image', 'url()');
                        $('#error-password-message').text(data.password_message);
                    }

                },
                error: function(data) {

                    $.each(data.responseJSON.errors, function(name, message) {

                        $('#error-' + name).addClass('is-invalid');
                        $('#error-' + name).css('border', '1px solid red');
                        $('#error-' + name).css('background-image', 'url()');
                        $('#error-' + name + '-message').text(message);

                    }); //end of each

                }, //end of success
                
            });//end of ajax

        });//end of submit login

        $(document).on('submit', '#auth-register', function (e) {
            e.preventDefault();

            let url    = $(this).attr('action');
            let method = $(this).attr('method');
            let data   = $(this).serialize();
            var items  = $(this).serializeArray();

            $.each(items, function(index, item) {

                $('#error-register-' + item.name).removeClass('is-invalid');
                $('#error-register-' + item.name).css('border', '1px solid #E3E3E3');
                $('#error-register-' + item.name).css('background-image', 'url()');
                $('#error-register-' + item.name + '-message').text('');

            }); //end of each

            $.ajax({
                url: url,
                data: data,
                method: method,
                success: function (data) {

                    if(data.login == true) {
                        
                        swal({
                            title: data.success,
                            type: "success",
                            icon: 'success',
                            buttons: false,
                            timer: 1000
                        }); //end of swal

                        location.reload();
                    }
                    
                },
                error: function(data) {

                    $.each(data.responseJSON.errors, function(name, message) {

                        $('#error-register-' + name).addClass('is-invalid');
                        $('#error-register-' + name).css('border', '1px solid red');
                        $('#error-register-' + name).css('background-image', 'url()');
                        $('#error-register-' + name + '-message').text(message);

                    }); //end of each

                }, //end of success
                
            });//end of ajax

        });//end of submit register

    });//end of document ready
</script>