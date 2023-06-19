<script type="text/javascript">

    $(document).ready(function () {

        var choose = "{{ trans('admin.global.choose') }}";

        $(document).on('change', '#categories', function (e) {
            e.preventDefault();

            resetItem('categories');

            let id   = $(this).val();
            let lang = "{{ app()->getLocale() }}";
            let subCategoriesGroupBy = @json($subCategoriesGroupBy);
            
            if(subCategoriesGroupBy[id]) {
                
                $('#sub_categories-hidden').attr('hidden', false);
                $('#sub_categories').attr('disabled', false).empty('');

                $('#sub_categories').append(`<option selected disabled value="">${choose}</option>`);

                $.each(subCategoriesGroupBy[id], function(index, item) {
                    
                    $('#sub_categories').append(`<option value="${item.id}">${item.name[lang]}</option>`);

                });

            } else {

                $('#sub_categories-hidden').attr('hidden', true);
                $('#sub_categories').attr('disabled', true).empty('');

            }//end of if 

        });//end of change categories

        $(document).on('change', '#sub_categories', function (e) {
            e.preventDefault();

            resetItem('sub_categories');

            let id    = $(this).val();
            let name  = $(this).find(':selected').text();
            let lang  = "{{ app()->getLocale() }}";

            let subCategories = @json($subCategories);
            let cardsCategory = @json($cardsCategory);

            let currencyPrice = "{{ session('currency_price') ?? 0 }}";
            let currencyName  = "{{ session('currency_name') ?? '$' }}";

            if (subCategories[id]) {

                let styleColor = `background: linear-gradient(180deg, ${subCategories[id][0].color_1} 0%, ${subCategories[id][0].color_2} 100%);`;
                $('.box-card').attr('style', styleColor);
                $('.card-sub_category').text(name);
                $('.card-title').text(subCategories[id][0].title_card[lang]);

            }//end mof if

            if (subCategories[id][0].has_market) {

                $('#market_id-hidden').attr('hidden', false);
                $('#market_id').attr('disabled', false).empty('');

                $('.nav-market').attr('hidden', false);

                $('#market_id').append(`<option selected disabled value="">${choose}</option>`);

                $.each(subCategories[id][0].markets, function(index, item) {
                    
                    $('#market_id').append(`<option value="${item.id}">${item.name[lang]}</option>`);

                });


            } else {

                $('#market_id-hidden').attr('hidden', true);
                $('#market_id').attr('disabled', true).empty('');

                $('#card_id-hidden').attr('hidden', false);
                $('#card_id').attr('disabled', false).empty();

                $('.nav-market').attr('hidden', true);

                $('#card_id').append(`<option selected disabled value="">${choose}</option>`);

                $.each(cardsCategory[id], function(index, item) {

                    var newPrice = currencyPrice * item.price;
                    
                    $('#card_id').append(`<option value="${item.id}">${newPrice + ' ' + currencyName}</option>`);

                });

            }//end of if

        });//end of change sub_categories

        $(document).on('change', '#market_id', function (e) {
            e.preventDefault();

            resetItem('market_id');

            let id    = $(this).find(':selected').val();
            let name  = $(this).find(':selected').text();
            let lang  = "{{ app()->getLocale() }}";
            let cards = @json($cards);
            
            let currencyPrice = "{{ session('currency_price') ?? 0 }}"
            let currencyName  = "{{ session('currency_name') ?? '$' }}"


            $('.card-market').text(name);


            if (cards[id]) {

                $('#card_id-hidden').attr('hidden', false);
                $('#card_id').attr('disabled', false).empty();

                $('#card_id').append(`<option selected disabled value="">${choose}</option>`);

                $.each(cards[id], function(index, item) {

                    var newPrice = currencyPrice * item.price;
                    
                    $('#card_id').append(`<option value="${item.id}">${newPrice + ' ' + currencyName}</option>`);

                });

            } else {

                $('#card_id-hidden').attr('hidden', true);
                $('#card_id').attr('disabled', true).empty('');

            }//end of if

        });//end of change market_id

        $(document).on('change', '#card_id', function (e) {
            e.preventDefault();

            let id    = $(this).find(':selected').val();
            let price = $(this).find(':selected').text();
            let lang  = "{{ app()->getLocale() }}";
            let cards = @json($cards);

            $('.card-price').text(price);

            $('#btn-next').attr('hidden', false).attr('disabled', false);

            $('.nav-card').addClass('puchDone');

        });//end of change market_id

        $(document).on('click', '#btn-next', function (e) {
            e.preventDefault();

            let id     = $('#card_id').find(':selected').val();
            let url    = `/cart/add/${id}`; 
            let method = 'get';

            $.ajax({
                url: url,
                method: method,
                success: function (cart) {

                    swal({
                        title: cart.message,
                        type: 'success',
                        icon: 'success',
                        buttons: false,
                        timer: 15000
                    }); //end of swal

                    location.reload();

                },
                error: function (response) {

                    data = response.responseJSON.message;

                    swal({
                        title: data + '😥',
                        type: 'error',
                        icon: 'error',
                        buttons: false,
                        timer: 15000
                    }); //end of swal

                }, //end of success
                
            });//end of ajax

        });//end of change market_id

        function resetItem(model = '') 
        {
            if(model == 'categories') {

                $('#sub_categories-hidden, #market_id-hidden, #card_id-hidden').attr('hidden', true);
                $('#sub_categories, #market_id, #card_id').attr('disabled', true).empty('');
                $('#btn-next').attr('hidden', true).attr('disabled', true);

                $('.box-card').attr('style', '');
                $('.card-sub_category').text('');
                $('.card-title').text('');
                $('.card-market').text('');
                $('.card-price').text('');

                $('.purchase-nav').removeClass('puchDone');
                $('.nav-category').addClass('puchDone');

            }//end of categories

            if(model == 'sub_categories') {

                $('#market_id-hidden, #card_id-hidden').attr('hidden', true);
                $('#market_id, #card_id').attr('disabled', true).empty('');
                $('#btn-next').attr('hidden', true).attr('disabled', true);

                $('.card-market').text('');
                $('.card-price').text('');

                $('.nav-card, .nav-market').removeClass('puchDone');
                $('.nav-sub_category').addClass('puchDone');

            }//end of sub_categories

            if(model == 'market_id') {

                $('#card_id-hidden').attr('hidden', true);
                $('#card_id').attr('disabled', true).empty('');
                $('#btn-next').attr('hidden', true).attr('disabled', true);

                $('.card-price').text('');

                // nav 
                $('.nav-card').removeClass('puchDone');
                $('.nav-market').addClass('puchDone');

            }//end of market_id

        }//end of fun 

    });//end of document ready
</script>