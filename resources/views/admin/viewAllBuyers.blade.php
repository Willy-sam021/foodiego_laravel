@extends('admin.admin-layout.adminDashTemp')
@section('yield', 'admin-Dashboard')
@section('content')
<main class="content">

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 fw-bold text-dark">Buyer Dashboard</h2>
            <p class="text-muted">Manage and view all registered buyers</p>
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
                            <h5 class="card-title text-white mb-0">Total Buyers</h5>
                            <h2 class="display-5 fw-bold text-white mb-0">
                                <?php echo count($buyers); ?>
                            </h2>
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
                    <h5 class=" m-md-2 text-dark">All Buyers</h5>
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
                                    <th class="text-center">view more</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse ($buyers as $buyer )
                                        <tr>
                                            <td><h6 class="mb-0 text-sm">#{{$buyer->id}}</h6></td>
                                            <td><p class="text-sm font-weight-bold mb-0 text-capitalize">{{$buyer->name}}</p></td>
                                            <td><p class="text-sm mb-0">{{$buyer->email}}</p></td>
                                            <td><p class="text-sm mb-0">{{$buyer->phone}}</p></td>
                                            <td><p class="text-sm mb-0">{{(date('d M, Y', strtotime($buyer->created_at)))}}</p></td>
                                            <td class="text-center admin-buyers-btn-group">
                                                 <a href= {{route('userDetails',['user'=>$buyer->id])}} class="text-decoration-none btn btn-sm btn-info me-2">View more</a>
                                            </td>
                                        </tr>
                                    @empty
                                      <td colspan="6"><p class="text-center alert alert-danger">No buyers found.</p></td>

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
