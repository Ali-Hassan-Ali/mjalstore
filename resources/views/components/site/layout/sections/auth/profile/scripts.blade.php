<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });

    $(document).on('submit', '#profile-main', function (e) {
        e.preventDefault();

        let url      = $(this).attr('action');
        let method   = $(this).attr('method');
        var items    = $(this).serializeArray();
        var formData = new FormData(this);

        $.each(items, function(index, item) {

            $('#error-profile-main-' + item.name).removeClass('is-invalid');
            $('#error-profile-main-' + item.name).css('border', '1px solid #E3E3E3');
            $('#error-profile-main-' + item.name).css('background-image', 'url()');
            $('#error-profile-main-' + item.name + '-message').text('');

        }); //end of each

        $.ajax({
            url: url,
            data: formData,
            method: method,
            contentType: false,
            processData: false,
            success: function (data) {

                swal({
                    title: data,
                    type: "success",
                    icon: 'success',
                    buttons: false,
                    timer: 1000
                }); //end of swal

            },
            error: function(data) {

                $.each(data.responseJSON.errors, function(name, message) {

                    $('#error-profile-main-' + name).addClass('is-invalid');
                    $('#error-profile-main-' + name).css('border', '1px solid red');
                    $('#error-profile-main-' + name).css('background-image', 'url()');
                    $('#error-profile-main-' + name + '-message').text(message);

                }); //end of each

            }, //end of success
            
        });//end of ajax

    });//end of submit profile main
    
</script>