@extends('admin.admin-layout.adminDashTemp')
@section('yield', 'admin-Dashboard')
@section('content')
<main class="content">

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 fw-bold text-dark">Order Dashboard</h2>
            <p class="text-muted">View Order Detail.</p>
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
                    <h5 class="mb-0 text-dark">All Buyers</h5>
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
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($buyers)): ?>
                                    <?php foreach ($buyers as $buyer): ?>
                                        <tr>
                                            <td><h6 class="mb-0 text-sm">#<?= htmlspecialchars($buyer['buyer_id']) ?></h6></td>
                                            <td><p class="text-sm font-weight-bold mb-0 text-capitalize"><?= htmlspecialchars($buyer['buyer_fname'] . ' ' . $buyer['buyer_lname']) ?></p></td>
                                            <td><p class="text-sm mb-0"><?= htmlspecialchars($buyer['buyer_email']) ?></p></td>
                                            <td><p class="text-sm mb-0"><?= htmlspecialchars($buyer['buyer_phone']) ?></p></td>
                                            <td><p class="text-sm mb-0"><?= htmlspecialchars(date('M d, Y', strtotime($buyer['created_at']))) ?></p></td>
                                            <td class="text-center admin-buyers-btn-group">
                                                <button class="btn btn-sm btn-info me-2">View</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No buyers found.</td>
                                    </tr>
                                <?php endif; ?>
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
