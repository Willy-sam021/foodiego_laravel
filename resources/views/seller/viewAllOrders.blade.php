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

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle seller-dashboard__orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Product</th>
          <th>Amount</th>
          <th>Status</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>

            @forelse ($orders as $order )
                @foreach ($order->items as $item )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$order->total_price}}</td>
                        <td><span class="seller-dashboard__status seller-dashboard__status--pending">{{$order->status}}</span></td>
                        <td class="text-center">
                            <button class="btn btn-success btn-sm seller-dashboard__btn">Confirm</button>
                            <button class="btn btn-danger btn-sm seller-dashboard__btn">Cancel</button>
                        </td>
                    </tr>
                @endforeach
            @empty
               <p class="alert alert-danger">No orders Yet</p>

        @endforelse

      </tbody>
    </table>
  </div>

  <!-- Orders Cards (Mobile View) -->
  <div class="seller-dashboard__orders-cards">
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Order #1001</h5>
        <p><strong>Customer:</strong> John Doe</p>
        <p><strong>Product:</strong> Wireless Headphones</p>
        <p><strong>Amount:</strong> $80</p>
        <p><strong>Status:</strong>
          <span class="seller-dashboard__status seller-dashboard__status--pending">Pending</span>
        </p>
        <div class="d-flex gap-2">
          <button class="btn btn-success btn-sm seller-dashboard__btn">Confirm</button>
          <button class="btn btn-danger btn-sm seller-dashboard__btn">Cancel</button>
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Order #1002</h5>
        <p><strong>Customer:</strong> Mary Smith</p>
        <p><strong>Product:</strong> Smartwatch</p>
        <p><strong>Amount:</strong> $120</p>
        <p><strong>Status:</strong>
          <span class="seller-dashboard__status seller-dashboard__status--confirmed">Confirmed</span>
        </p>
        <div class="d-flex gap-2">
          <button class="btn btn-danger btn-sm seller-dashboard__btn">Cancel</button>
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Order #1003</h5>
        <p><strong>Customer:</strong> James Lee</p>
        <p><strong>Product:</strong> Bluetooth Speaker</p>
        <p><strong>Amount:</strong> $50</p>
        <p><strong>Status:</strong>
          <span class="seller-dashboard__status seller-dashboard__status--canceled">Canceled</span>
        </p>
        <div class="d-flex gap-2">
          <button class="btn btn-success btn-sm seller-dashboard__btn">Confirm</button>
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
