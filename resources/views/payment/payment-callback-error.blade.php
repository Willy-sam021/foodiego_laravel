@extends('layout-vege.site')

@section('pageName', 'Payment error')


@section('feature1')
<div class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow-lg p-4 text-center" >
    <!-- Error Icon -->
    <div class="mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
        <path d="M7.938 2.016a.13.13 0 0 1 .125 0l6.857 11.856c.037.064.037.144 0 .208a.13.13 0 0 1-.125.064H1.205a.13.13 0 0 1-.125-.064.176.176 0 0 1 0-.208L7.938 2.016zM8 4.905c-.535 0-.954.462-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507a.905.905 0 0 0-.9-.995zM8 12a1.002 1.002 0 1 0 0 2.004A1.002 1.002 0 0 0 8 12z"/>
      </svg>
    </div>

    <!-- Message -->
    <h2 class="fw-bold text-dark">Payment Failed</h2>
    <p class="text-muted mt-2">
      Oops! Something went wrong and your payment could not be completed.<br>
      Please try again or use another payment method.
    </p>

    <!-- Error Details (optional) -->
    <div class="alert alert-danger mt-3 text-start small">
      <p class="mb-1"><strong>Error Code:</strong> PAY_ERR_500</p>
      <p class="mb-0"><strong>Message:</strong> Transaction declined</p>
    </div>

    <!-- Buttons -->
    <div class="d-grid gap-2 mt-4">
      <a href="/checkout" class="btn btn-danger">Try Again</a>
      <a href="/" class="btn btn-secondary">Go Back Home</a>
    </div>
  </div>

</div>
@endsection

