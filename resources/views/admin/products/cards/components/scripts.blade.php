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
        $('#sub_category-card').text($(this).find(':selected').text());
        
        $.ajax({
            url: url,
            success: function (data) {

                let style = `background: linear-gradient(180deg, ${data.color1} 0%, ${data.color2} 100%)`;

                $('.box-card').attr('style', style);
                $('#title-card').text(data.titleCard);
                $('#color').val(style);

                if(data.has_market) {

                    $('#market_id-hidden').attr('hidden', false);
                    $('#market_id').empty('').attr('disabled', false).append(`<option selected disabled>Choose</option>`);

                    $.each(data.items, function(index,item) {

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

    $(document).on('change keyup', '#price', function () {

        $('#price-card').text(this.value + '$');

    });

    $(document).on('change', '#market_id', function () {

        $('#market-card').text($(this).find(':selected').text());

    });

    @if(!empty($card))
        let color1 = "{{ $card->subCategory?->color_1 }}";
        let color2 = "{{ $card->subCategory?->color_2 }}";
        let style  = `background: linear-gradient(180deg, ${color1} 0%, ${color2} 100%)`;

        $('.box-card').attr('style', style);
    @endif

    if("{{ old('sub_category') }}") {

        let subCategoryMarkets = @json($subCategoryMarkets);
        let subCategoryId      = "{{ old('sub_category') }}";

        let color1 = subCategoryMarkets[subCategoryId][0].color_1;
        let color2 = subCategoryMarkets[subCategoryId][0].color_2;
        let style  = `background: linear-gradient(180deg, ${color1} 0%, ${color2} 100%)`;

        $('.box-card').attr('style', style);

    }//end of if

    if("{{ old('market_id', !empty($card) ? $card?->market_id : '') }}") {

        let subCategoryMarkets = @json($subCategoryMarkets);
        let subCategoryId      = "{{ old('sub_category', !empty($card) ? $card?->category_id : '') }}";
        let MarketsId          = "{{ old('market_id', !empty($card) ? $card?->market_id : '') }}";
        let lang               = "{{ app()->getLocale() }}";

        if(subCategoryMarkets[subCategoryId][0]['markets'].length) {

            $('#market_id-hidden').attr('hidden', false);
            $('#market_id').empty('').attr('disabled', false).append(`<option selected disabled>Choose</option>`);

            $.each(subCategoryMarkets[subCategoryId][0]['markets'], function(index, item) {

                var html = `<option ${item.id == MarketsId ? 'selected' : ''} value="${item.id}">${item.name[lang]}</option>`;

                $('#market_id').append(html);

            });//end of each

        } else {

            $('#market_id-hidden').attr('hidden', true);
            $('#market_id').empty('').attr('disabled', true).append(`<option selected disabled>Choose</option>`);


        }//end of check markets

    } //end of if


    if($('#sub_category').find(':selected').text()) {
        $('#sub_category-card').text($('#sub_category').find(':selected').text());
    }

    if($('#market_id').find(':selected').text()) {
        $('#market-card').text($('#market_id').find(':selected').text());
    }

    $('#price-card').text($('#price').val() + '$');

</script>