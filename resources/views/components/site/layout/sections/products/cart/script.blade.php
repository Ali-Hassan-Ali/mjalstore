<script type="text/javascript">

    $(document).ready(function () {

        $(document).on('click', '.add-to-cart', function (e) {
            e.preventDefault();

            let id     = $(this).data('id');
            let url    = `/cart/add/${id}`; 
            let method = 'post';

            $.ajax({
                url: url,
                method: method,
                success: function (cart) {

                    $('#cart-menu-count').text(cart.count);
                    $('.cart-total').text(cart.subtotal);

                    swal({
                        title: cart.message,
                        type: 'success',
                        icon: 'success',
                        buttons: false,
                        timer: 15000
                    }); //end of swal

                    if ($('#cart-' + cart.item.uuid).length === 1) {

                        $('#total-price-' + cart.item.uuid).text(cart.item.total_price);
                        $('#quantity-' + cart.item.uuid).val(cart.item.quantity);

                    } else {

                        let html = `<li id="cart-${cart.item.uuid}">
                                        <div class="image-product" style="background: linear-gradient(180deg, ${cart.item.color_1} 0%, ${cart.item.color_2} 100%)">
                                            <p class="text-light mt-3">${cart.item.sub_category}</p>
                                            <a class="remove-product" data-uuid="${cart.item.uuid}"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <div class="title-cart">
                                            <p><a href="#">${cart.item.title_card}</a></p>
                                            <div class="price-counter">
                                                <strong id="total-price-${cart.item.uuid}">${cart.item.total_price}</strong>
                                                <div class="quantity-item">
                                                    <div class="quantity">
                                                        <input type="text" name="count-quat1" class="count-quat" value="${cart.item.quantity}" id="quantity-${cart.item.uuid}">
                                                        <div class="btn button-count inc change-quantity jsQuantityIncrease" data-uuid="${cart.item.uuid}"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                                        <div class="btn button-count dec change-quantity jsQuantityDecrease disabled" minimum="1" data-uuid="${cart.item.uuid}"><i class="fa fa-minus" aria-hidden="true"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;

                        $('#cart-menu-item').append(html);

                    }//end of if

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

        });//end of click add-to-card

        $(document).on('click', '.remove-product', function (e) {
            e.preventDefault();

            swal({
                title: "{{ trans('admin.global.confirm') }}",
                type: "error",
                icon: "warning",
                buttons: {
                        cancel: "{{ trans('admin.global.no') }}",
                        defeat: "{{ trans('admin.global.yes') }}"
                    },
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {

                    $(this).parent().parent().remove();

                    let uuid   = $(this).data('uuid');
                    let url    = `/cart/delete/${uuid}`; 
                    let method = 'delete';

                    $.ajax({
                        url: url,
                        method: method,
                        success: function (cart) {

                            $('#cart-menu-count').text(cart.count);
                            $('.cart-total').text(cart.subtotal);

                            swal({
                                title: cart.message,
                                type: 'success',
                                icon: 'success',
                                buttons: false,
                                timer: 15000
                            }); //end of swal

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

                }; //end of if

            }); //then

        });//end of click add-to-card

        $(document).on('click', '.change-quantity', function (e) {
            e.preventDefault();

            let uuid       = $(this).data('uuid');
            let quantity = $('#quantity-' + uuid).val();
            let url      = `/cart/update`; 
            let method   = 'put';
            let data     = {quantity: quantity, uuid: uuid};

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function (cart) {

                    // swal({
                    //     title: cart.message,
                    //     type: 'success',
                    //     icon: 'success',
                    //     buttons: false,
                    //     timer: 15000
                    // }); //end of swal

                    $('.cart-total').text(cart.subtotal);
                    $('#total-price-' + cart.item.uuid).text(cart.item.total_price);
                    $('#quantity-' + cart.item.uuid).val(cart.item.quantity);

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

        });//end of click add-to-card

    });//end of document ready
</script>