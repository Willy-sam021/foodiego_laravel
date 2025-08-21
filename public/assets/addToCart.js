
    $(document).ready(function () {
        $('.add-to-cart-btn').click(function () {
            const productId = $(this).data('product-id');

            $.ajax({
                url: '{{ route("cart.add") }}',
                type: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Product added to cart!');
                        // Optional: update cart count
                    } else if (response.status === 'exists') {
                        alert('Product already in cart!');
                    }else if (response.status === 'failed') {
                        alert('Failed to add product to cart. Please try again.');
                    }
                },
                error: function () {
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
