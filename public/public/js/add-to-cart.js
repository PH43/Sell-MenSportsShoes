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
            url: '/product/add-to-cart',
            method: 'POST',
            data: {
                productId,
                quantity
            },
            success: function(data) {
                console.log(data);
                swal({icon: "success", title: "Thông báo!", text: "Đã thêm sản phẩm vào giỏ hàng thành công!"});
                let currentQuantity = $('#cartQuantity').text();
                $('#cartQuantity').text(parseInt(currentQuantity) + parseInt(quantity));
            },
            error: function(err) {
                console.log({err});
                swal({icon: "error", title: 'Error', text: 'There are error when add to cart, please try again'});
            }
        });
    });
})