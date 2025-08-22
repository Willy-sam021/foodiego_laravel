@extends('admin.admin-layout.adminDashTemp')
@section('yield', 'admin-Dashboard')
@section('content')
<main class="content">

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 fw-bold text-dark">Buyer Dashboard</h2>
            <p class="text-muted">view Buyer Details.</p>
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
                            <h5 class="card-title text-white mb-0">More about Buyer </h5>
                            @if (session('success'))
                                <p class="alert alert-success">{{session('success')}}</p>
                            @endif
                            @if (session('error'))
                                <p class="alert alert-danger">{{session('error')}}</p>
                            @endif
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
                    <h5 class="mb-0 text-dark">Buyer</h5>
                </div>
                <div class="admin-buyers-card-body p-0">
                    <div class="table-responsive">
                        <table class="table admin-buyers-table table-hover">
                            <thead>
                                <tr>
                                    <th>Buyer ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Registration Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($buyer)
                                    <tr>
                                        <td><h6 class="mb-0 text-sm">#{{$buyer->id}}</h6></td>
                                        <td><p class="text-sm font-weight-bold mb-0 text-capitalize">{{$buyer->name}}</p></td>
                                        <td><p class="text-sm mb-0">{{$buyer->email}}</p></td>
                                        <td><p class="text-sm mb-0">{{$buyer->phone}}</p></td>
                                        <td><p class="text-sm mb-0">{{(date('d M, Y', strtotime($buyer->created_at)))}}</p></td>
                                        <td class="text-center admin-buyers-btn-group">
                                            <form action="{{route('deleteUser',['user'=>$buyer->id])}}">
                                                @csrf @method('delete')
                                                    <button class=" btn btn-sm btn-danger me-2">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ORDER SECTION --}}
<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 fw-bold text-dark">Order Section</h2>
            <p class="text-muted">view buyer Orders.</p>
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
                            <h5 class="card-title text-white mb-0">More about Buyer </h5>
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
                    <h5 class="mb-0 text-dark">Buyer</h5>
                </div>
                <div class="admin-buyers-card-body p-0">
                    <div class="table-responsive">
                        <table class="table admin-buyers-table table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>payment status</th>
                                    <th>Delivery date</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody >
                             @forelse ($orders as $order )
                                @foreach ($order->items as $item )
                                    <tr>
                                        <td>{{$loop->iteration}}</td>

                                        <td>{{$item->product->name}}</td>

                                        <td>{{$item->weight}}</td>

                                        <td>{{$item->product->price_per_kg}}</td>

                                        <td>{{$order->payment_status}}</td>

                                        <td>{{$order->delivery_date}}</td>

                                        <td>{{$item->price}}</td>
                                    </tr>
                                @endforeach

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
