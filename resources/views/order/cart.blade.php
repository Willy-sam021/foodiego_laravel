@extends('layout-vege.site')
@section('pageName', 'Carts')
@section('feature1')
<div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    @if (session('success'))
                        <p class="alert alert-success">
                            {{session('success')}}
                        </p>

                    @endif
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart )
                                <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$cart->product->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="product image">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->product->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">N {{$cart->product->price_per_kg}}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity d-flex mt-4"">
                                        {{-- <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border me-1" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div> --}}

                                            <input type="text" min="1" class="update-qty form-control" data-cart-id="{{ $cart->id }}" data-price="{{ $cart->product->price_per_kg }}" value="{{ $cart->quantity }}">
                                            <button class="btn-update btn btn-primary">Update</button>
                                        {{-- <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border ms-1">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div> --}}
                                    </div>
                                </td>

                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 delete-cart" data-delete-cart="{{$cart->id}}">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <p class="alert alert-danger">Oops! your cart is empty</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row g-4 justify-content-end" id='cartVanish'>
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Total:</h5>
                                    {{-- {{dd($total_price)}} --}}
                                    <p class="mb-0" id='total-price'>{{$total_price}}</p>
                                </div>
                            </div>
                            <a href={{ route("checkout") }}  class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" >Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        $('.btn-update').on('click', function () {
            const cartId = $(this).siblings('.update-qty').data('cart-id');
            const quantity = $(this).siblings('.update-qty').val();
            const price = $(this).siblings('.update-qty').data('price');
            const total = quantity * price;
           
            $.ajax({
                url: '{{ route("cart.updateQuantity") }}',
                type: 'POST',
                data: {
                    cart_id: cartId,
                    quantity: quantity,
                    total_price: total,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success') {
                        // Update the UI without reload
                        alert('cart update successful');
                        location.reload(); // or update total with JS
                    }else if(response.status === 'failed'){
                        alert('failed to update cart');
                    }
                },
                error: function () {
                    alert('Update failed');
                }
            });
        });

        $('.delete-cart').click(function(){

            var res = confirm('Are you sure you want to remove this product from cart?');
            var cartId = $(this).data('delete-cart');
            if(res === true){
                $.ajax({
                    url: '{{ route("cart.delete") }}',
                    type: 'POST',
                    data: {
                        cart_id: cartId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            location.reload();
                        }else if(response.status === 'failed'){
                            alert('failed to delete cart');
                        }
                    },
                    error: function () {
                        alert('delete failed');
                    }
                });
            }

        });

        var Count = $('#cartCounter').html();
        if(Count <= 0){
            $('#cartVanish').hide();
        }






    });
</script>
@endsection
