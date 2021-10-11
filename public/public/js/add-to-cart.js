$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        let productId =$(this).data('product-id');
        let quantity = $('#quantity').val() ? $('#quantity').val() : 1;
        $.ajax({
            url: '/home/add-to-cart',
            method: 'POST',
            data: {
                productId,
                quantity
            },
            success: function(data) {
                console.log(data);
                if (data.status == 200) {
                    swal({icon: "success", title: "Thông báo!", text: data.message});
                    let currentQuantity = $('#cartQuantity').text();
                    $('#cartQuantity').text(parseInt(currentQuantity) + parseInt(quantity));
                } else {
                    swal({icon: "warning", title: "Thông báo!", text: data.message});
                }
            },
            error: function(err) {
                console.log({err});
                swal({icon: "error", title: 'Error', text: 'There are error when add to cart, please try again'});
            }
        });
    });
})