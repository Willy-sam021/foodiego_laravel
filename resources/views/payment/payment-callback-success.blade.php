@extends('layout-vege.site')

@section('pageName', 'Payment sucess')

@section('feature1')
<div class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow-lg p-4 text-center" >
    <!-- Success Icon -->
    <div class="mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
        <path d="M15.854 4.146a.5.5 0 0 0-.708-.708L7 11.293 4.854 9.146a.5.5 0 1 0-.708.708l2.5 2.5a.5.5 0 0 0 .708 0l8.5-8.5z"/>
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
      </svg>
    </div>

    <!-- Message -->
    <h2 class="fw-bold text-dark">Payment Successful</h2>
    <p class="text-muted mt-2">
      Thank you for your payment! Your transaction was completed successfully.
    </p>

    <!-- Transaction Details (optional) -->
    <div class="alert alert-success mt-3 text-start small">
      <p class="mb-1"><strong>Transaction ID:</strong> 123456789</p>
      <p class="mb-0"><strong>Amount Paid:</strong> $100.00</p>
    </div>

    <!-- Buttons -->
    <div class="d-grid gap-2 mt-4">
      <a href="/" class="btn btn-success">Go to Homepage</a>
      <a href="/orders" class="btn btn-outline-secondary">View Orders</a>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (with Popper) -->

</div>

@endsection
