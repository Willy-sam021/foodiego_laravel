@extends('layout-vege.site')
@section('pageName', 'Check Out')

@section('feature1')
<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="{{route('place-order')}}" method="POST">
                    @csrf
                    @foreach ($errors->all() as $error )
                       <p> {{$error}}</p>
                    @endforeach
                    @if(session('error'))
                        <p class= "alert alert-danger">{{session('error')}}</p>
                    @endif
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">


                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="House Number Street Name" name='shipping_address' value={{old('shipping_address')}}>
                                @error('shipping_address')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input type="tel" class="form-control" name='phone' value={{old('phone')}}>
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-item my-3">
                                <textarea name="notes" class="form-control"  spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)">{{old('notes')}}</textarea>
                                @error('notes')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart )


                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src={{asset("storage/{$cart->product->image}")}} class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{$cart->product->name}}</td>
                                            <td class="py-5">{{$cart->product->price_per_kg}}</td>
                                            <td class="py-5">{{$cart->quantity}}</td>
                                            <td class="py-5">{{$cart->total_price}}</td>
                                        </tr>

                                        @endforeach
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark py-3">Total</p>
                                            </td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">{{$total_price}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <h3>Select Payment Method</h3>
                                </div>
                            </div>

                            @error('payment_method')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" {{ old('payment_method') == 'cash' ? 'checked' : '' }} id="Payments-1" name="payment_method" value="cash">
                                        <label class="form-check-label" for="Payments-1">Cash</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}id="Delivery-1" name="payment_method" value="transfer">
                                        <label class="form-check-label" for="Delivery-1">Transfer </label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" {{ old('payment_method') == 'paystack' ? 'checked' : '' }}  name="payment_method" value="paystack">
                                        <label class="form-check-label" for="Paypal-1">Paystack</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
