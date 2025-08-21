@extends('layout-vege.site')

@section('pageName', 'Payment Confirmation')


@section('feature1')
<div class="order-confirmation-container">
        <div class="order-confirmation-header">
            <span class="order-confirmation-checkmark">✓</span>
            <h1 class="order-confirmation-title">Order Confirmed!</h1>

            @if(isset($error))
                <p class="alert alert-danger">FAILED PAYMENT</p>
            @endif
            <p class="order-confirmation-message">Thank you for your purchase. Your order has been received and is being processed Please proceed with payment</p>
        </div>

        <div class="order-details-section">
            <h2 class="order-details-title">Order #<span id="order-number"></span></h2>
            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>price</th>
                        <th>total</th>

                    </tr>
                </thead>
                <tbody >

                    @forelse ($orders as $order )
                    {{-- {{dd($yem)}} --}}
                        @foreach ($order->items as $item )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->product->name}}</td>

                                <td>{{$item->weight}}</td>

                                <td>{{$item->product->price_per_kg}}</td>

                                <td>{{$item->price}}</td>


                                {{-- <td>{{$item->mini_total}}</td> NO need for mini total --}}
                            </tr>
                        @endforeach

                        <div class="order-total-price">
                            Total: $<span>{{$order->total_price}}</span>
                         </div>
                     @empty

                        <p class="alert alert-danger">Nothing to show here</p>
                    @endforelse

                </tbody>
            </table>

        </div>


        <div class="order-action-buttons">
           <form action="{{route('paymentInitialize')}}" method="post">
                @csrf
                <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <h3>Select Currency</h3>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error )
                                <p>{{$error}}</p>

                            @endforeach
                            @error('payment_currency')
                                    <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-4">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" {{ old('payment_currency') == 'NGN' ? 'checked' : '' }} id="Payments-1" name="payment_currency" value="NGN">
                                        <label class="form-check-label" for="Payments-1">NGN</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" {{ old('payment_currency') == 'EUR' ? 'checked' : '' }} id="Payments-1" name="payment_currency" value="EUR">
                                        <label class="form-check-label" for="Payments-1">EUR</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" {{ old('payment_currency') == 'USD' ? 'checked' : '' }} id="Payments-1" name="payment_currency" value="USD">
                                        <label class="form-check-label" for="Payments-1">USD</label>
                                    </div>
                                </div>
                            </div>
                <button class="order-btn order-btn-secondary"> Proceed </button>
           </form>
        </div>
    </div>

@endsection
@section('javascript')
<script src="{{asset('assets/orderConf.js')}}"></script>

@endsection
