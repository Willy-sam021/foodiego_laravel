@extends('layout-vege.site')
@section('pageName', 'All Products')
@section('fruitshop')
<!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-3">
            <div class="container">
                <h1 class="mb-4">Frozen Foods </h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>

                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <select name="category" id="category-filter">
                                                            @forelse ($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @empty
                                                                <option disabled>No category available</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div>
                                                <button class="btn btn-success" id='btn-filter'>Apply filter</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="mb-2">Price</h4>
                                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                            <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="position-relative">
                                            <div class="d-flex justify-content-center my-4">
                                                <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                {{-- Category looping --}}
                                <div class="row mb-4 g-4 justify-content-center" id='category-products'>

                                </div>
                                {{-- CATEGORY LOOPING ENDS --}}
                                {{-- PRODUCTS LOOPING STARTS --}}
                                <div class="row g-4 justify-content-center">
                                    @forelse ($products as $product )
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="{{route('productDetail',['id'=>$product->id])}}">
                                                    <div class="fruite-img">
                                                        <img src={{asset("storage/$product->image")}} class="img-fluid w-100 rounded-top" alt="">
                                                    </div>
                                                </a>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Frozen</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{$product->name}}</h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><span>vendor name</span> {{$product->seller->name}}</p>
                                                        <p class="text-dark fs-5 fw-bold mb-0">N {{$product->price_per_kg}} / kg</p>
                                                        <button type="submit" class="btn btn-success add-to-cart-btn" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-bag me-2 text-primary "></i> Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="alert  alert-danger">No products available</p>
                                    @endforelse
                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            @if($products){{$products->links()}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->

@endsection
@section('javascript')
{{-- <script src="{{asset('assets/addToCart.js')}}">

</script> --}}
<script>
$(document).ready(function () {
        $('.add-to-cart-btn').click(function () {
            const productId = $(this).data('product-id');
            //console.log('Product ID:', productId);
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
                        var Cart = $('#cartCounter').html()
                        var addCart= Number(Cart) + 1;
                        $('#cartCounter').html(addCart)
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

         $('#btn-filter').click(function(){
        var categoryId = $('#category-filter').val();
        alert(categoryId)
        $.ajax({
            url: '{{ route("categoryFilter") }}', // Use correct route for filtering products
            type: 'POST',
            data: {
                category_id: categoryId,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response)
                if (response.status === 'success') {
                    let products = response.data;
                    $('#category-products').empty();
                    $.each(products, function(index, product) {
                        let productDetailUrl = '/product/detail/' + product.id; // Adjust as needed
                        let productImageUrl = '/storage/' + product.image; // Adjust as needed
                        let sellerName = product.seller ? product.seller.name : 'Unknown';
                        let productHtml = `
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <a href="${productDetailUrl}">
                                        <div class="fruite-img">
                                            <img src="${productImageUrl}" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                    </a>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Frozen</div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>${product.name}</h4>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0"><span>vendor name</span> ${sellerName}</p>
                                            <p class="text-dark fs-5 fw-bold mb-0">N ${product.price_per_kg} / kg</p>
                                            <button type="submit" class="btn btn-success add-to-cart-btn" data-product-id="${product.id}"><i class="fa fa-shopping-bag me-2 text-primary "></i> Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#category-products').append(productHtml);
                    });
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
