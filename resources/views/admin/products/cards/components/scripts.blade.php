<script type="text/javascript">
    $(document).on('change', '#category_id', function (e) {
        e.preventDefault();

        let id     = $(this).val();
        var url    = '/admin/products/cards/sub_categories/' + id;
        
        $.ajax({
            url: url,
            success: function (data) {

                $('#market_id-hidden').attr('hidden', true);
                $('#market_id').attr('disabled', true);

                $('#sub_category').attr('disabled', false);
                $('#sub_category').empty('');
                $('#sub_category').append(`<option selected disabled>Choose</option>`);

                $.each(data, function(index,item) {

                    var html = `<option value="${index}">${item}</option>`;

                    $('#sub_category').append(html);

                });//end of each
                
            }//end of success
        });//end of ajax
    });

    $(document).on('change', '#sub_category', function (e) {
        e.preventDefault();

        let id     = $(this).val();
        var url    = '/admin/products/cards/markets/' + id;
        
        $.ajax({
            url: url,
            success: function (data) {

                if(data) {

                    $('#market_id-hidden').attr('hidden', false);
                    $('#market_id').empty('').attr('disabled', false).append(`<option selected disabled>Choose</option>`);

                    $.each(data, function(index,item) {

                        var html = `<option value="${index}">${item}</option>`;

                        $('#market_id').append(html);

                    });//end of each

                } else {

                    $('#market_id-hidden').attr('hidden', true);
                    $('#market_id').attr('disabled', true);

                }//end of if

            }//end of success
        });//end of ajax

    });
</script>