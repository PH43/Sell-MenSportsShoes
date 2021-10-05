$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        let productId =$(this).data('product-id');
        $.ajax({
            url: '/product/add-to-cart',
            method: 'POST',
            data: {
                productId: productId
            },
            success: function(data) {
                console.log(data);
            },
            error: function(err) {
                console.log({err});
            }
        })
    });

})