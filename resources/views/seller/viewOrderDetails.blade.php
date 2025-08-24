@extends('seller.layout.sellerDashTemp')
@section('content')
<main= class='content'>
    <div class="seller-dashboard container">
  <div class="seller-dashboard__header mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <h1 class="seller-dashboard__title"> Orders</h1>

    <!-- Search + Filter Bar -->
    <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto">
      <input type="text" class="form-control" placeholder="Search orders...">
      <select class="form-select">
        <option value="all">All Statuses</option>
        <option value="pending">Pending</option>
        <option value="confirmed">Confirmed</option>
        <option value="canceled">Canceled</option>
      </select>
      <button class="btn btn-primary">Filter</button>
    </div>
  </div>

  <!-- Orders Table (Desktop View) -->
  {{-- EROR MESSAGES --}}

    @error('delivery_date')
        <p class="alert alert-danger">{{$message}}</p>
    @enderror
    @if (session('success'))
        <p class="alert alert-success">{{session('success')}}</p>
    @endif
    @if (session('error'))
        <p class="alert alert-danger">{{session('error')}}</p>
    @endif

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle seller-dashboard__orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>

          <th>Amount</th>
          <th>Order Status</th>
          <th>Payment Status</th>

          {{-- <th class="text-center">Actions</th> --}}
        </tr>
      </thead>
      <tbody>

            @forelse ($orders as $order )
                @foreach ($order->items as $item )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->total_price}}</td>
                        <td><span class="seller-dashboard__status seller-dashboard__status--pending">{{$order->status}}</span></td>
                        <td><span class="seller-dashboard__status seller-dashboard__status--pending">{{$order->payment_status}}</span></td>
                    </tr>
                @endforeach
            @empty
               <p class="alert alert-danger">No orders Yet</p>

        @endforelse

      </tbody>
    </table>
  </div>

  <!-- Orders Page -->
<div class="container my-4">

    <!-- Products Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Products</h4>
        </div>

        @forelse ($orders as $order)
            @foreach ($order->items as $item)
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                 alt="product picture"
                                 class="rounded-circle me-3"
                                 style="width: 70px; height: 70px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1">{{ $item->product->name }}</h6>
                                <small class="text-muted">₦{{ number_format($item->product->price_per_kg) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="col-12">
                <p class="alert alert-danger">No orders yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Delivery Status Section -->
    <!-- Delivery Status Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Delivery Status</h5>
                </div>
                <div class="card-body">

                    @if ($delivery && $delivery->exp_delivery_date)
                        <!-- Show already set delivery dates -->

                            <p>
                                Expected Delivery:
                                <strong>{{ $delivery->exp_delivery_date }}</strong>
                            </p>


                        <!-- Disable form if already set -->
                        <div class="alert alert-info">
                            Delivery date has already been set. You cannot change it again.
                        </div>
                    @else
                        <!-- Show form only if no delivery date exists -->
                        <form action="{{ route('setDeliveryDate', ['order' => $order->id ?? null]) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="date" name="delivery_date" class="form-control w-auto" required>
                            <button type="submit" class="btn btn-success btn-sm">Set Date</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Change Delivery Status Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Change Delivery Status</h5>
                </div>
                <div class="card-body">
                    @if ($delivery && $delivery->delivered_at)
                         <div class="alert alert-info">
                            Delivery Completed.
                        </div>
                    @else
                        <form action="{{route('deliveryComplete',['delivery'=>$delivery ?? null])}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-check mb-2">
                                <input type="radio" class="form-check-input" id="statusPending" name="delivery_status" value="pending">
                                <label for="statusPending" class="form-check-label">Pending</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="radio" class="form-check-input" id="statusDelivered" name="delivery_status" value="delivered">
                                <label for="statusDelivered" class="form-check-label">Delivered</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Set Status</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>







</div>
</main>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
