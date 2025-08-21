@extends('layout-vege.site')

@section('pageName', 'Order Confirmation')


@section('feature1')
<div class="order-confirmation-container">
        <div class="order-confirmation-header">
            <span class="order-confirmation-checkmark">✓</span>
            <h1 class="order-confirmation-title">Order Confirmed!</h1>
            <p class="order-confirmation-message">Thank you for your purchase. Your order has been received and is being processed.</p>
        </div>

        <div class="order-details-section">
            <h2 class="order-details-title">Order #<span id="order-number"></span></h2>
            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody >
                    @forelse ($orders as $order )
                    {{-- {{dd($item)}} --}}
                        @foreach ($order->items as $item )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->product->name}}</td>

                                <td>{{$item->weight}}</td>

                                <td>{{$item->product->price_per_kg}}</td>

                                <td>{{$item->price}}</td>


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

        <div class="shipping-info-section">
            <h2 class="shipping-info-title">Shipping Information</h2>
            <p><strong>Estimated Delivery:</strong> <span id="delivery-date"></span></p>
            <p><strong>Shipping Address:</strong> <span id="shipping-address"></span></p>
        </div>

        <div class="order-action-buttons">
            <a href="#" class="order-btn order-btn-primary">View Order Details</a>
            <a href="{{route('products')}}" class="order-btn order-btn-secondary">Continue Shopping</a>
        </div>
    </div>

@endsection
@section('javascript')
<script src="{{asset('assets/orderConf.js')}}"></script>

@endsection
