@extends('admin.admin-layout.adminDashTemp')
@section('yield', 'admin-Dashboard')
@section('content')
<main class="content">

<div class="container-fluid py-4">
    {{-- ORDER SECTION --}}
<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 fw-bold text-dark">Order Section</h2>
            <p class="text-muted">view and manage all Orders.</p>
        </div>
        <div class="col-md-6 d-flex justify-content-md-end">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search buyers..." aria-label="Search buyers">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white admin-buyers-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title text-white mb-0">All orders</h5>
                            {{-- <h2 class="display-5 fw-bold text-white mb-0">
                                <?php echo count($orders); ?>
                            </h2> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card admin-buyers-card">
                <div class="admin-buyers-card-header">
                    <h5 class="mb-0 text-dark">Order</h5>
                </div>
                <div class="admin-buyers-card-body p-0">
                    <div class="table-responsive">
                        <table class="table admin-buyers-table table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>payment status</th>
                                    <th>Delivery date</th>
                                    <th class="text-center">view more</th>

                                </tr>
                            </thead>
                            <tbody >

                             @forelse ($orders as $order )
                              {{-- {{dd($orders)}} --}}
                                <tr>
                                    <td>{{$loop->iteration}}</td>

                                    <td>{{$order->user->name}}</td>

                                    <td>{{$order->total_price}}</td>

                                    <td>{{$order->payment_status}}</td>

                                    <td>{{$order->delivery_date}}</td>

                                    <td class="text-center admin-buyers-btn-group">
                                        <a href= {{route('orderDetails',['order'=>$order->id])}} class="text-decoration-none btn btn-sm btn-info me-2">View more</a>
                                    </td>

                                </tr>

                            @empty
                                <td>
                                    <p class="alert alert-danger">Nothing to show here</p>
                                </td>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
@endsection
