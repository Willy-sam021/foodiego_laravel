@extends('layout-vege.site')
@section('pageName', 'Seller Registration')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="row g-0">

                    <!-- Left Side Image -->
                    <div class="col-md-5 d-none d-md-block">
                        <img src="{{asset('images/seller_woman.jpg')}}"
                             alt="Seller Illustration"
                             class="img-fluid h-100 w-100"
                             style="object-fit: cover;">
                    </div>

                    <!-- Right Side Form -->
                    <div class="col-md-7 p-4 p-md-5 bg-light">
                        <h2 class="text-center mb-4 fw-bold text-success">Seller Registration</h2>

                        @if (session('error'))
                            <p class="alert alert-danger text-center">
                                {{ session('error') }}
                            </p>
                        @endif

                        <form action="{{ route('seller.register.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Business Name -->
                            <div class="mb-3">
                                <label for="vendor_name" class="form-label fw-semibold">Business Name <span class="text-danger">*</span></label>
                                <input type="text" name="vendor_name" id="vendor_name"
                                    class="form-control rounded-3 @error('vendor_name') is-invalid @enderror"
                                    value="{{ old('vendor_name') }}" required>
                                @error('vendor_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Government NIN -->
                            <div class="mb-3">
                                <label for="government_nin" class="form-label fw-semibold">Government NIN (Image File) <span class="text-danger">*</span></label>
                                <small class="text-danger">Only pdf*,jpg*,jpeg*,png* max=5mb </small>
                                <input type="file" name="government_nin" id="government_nin"
                                    class="form-control rounded-3 @error('government_nin') is-invalid @enderror" required>
                                @error('government_nin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Business Address -->
                            <div class="mb-3">
                                <label for="business_address" class="form-label fw-semibold">Business Address <span class="text-danger">*</span></label>
                                <textarea name="business_address" id="business_address" rows="3"
                                    class="form-control rounded-3 @error('business_address') is-invalid @enderror" required>{{ old('business_address') }}</textarea>
                                @error('business_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Business Type -->
                            <div class="mb-3">
                                <label for="business_type" class="form-label fw-semibold">Business Type <span class="text-danger">*</span></label>
                                <div class="d-flex gap-3 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="business_type" id="individual"
                                            value="individual" {{ old('business_type') == 'individual' ? 'checked' : '' }} required>
                                       <span class="ms-1" for="individual">Individual</span>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="business_type" id="company"
                                            value="company" {{ old('business_type') == 'company' ? 'checked' : '' }}>
                                        <span class="ms-1" for="company">Company</span>
                                    </div>
                                </div>
                                @error('business_type')
                                    <div class="text-danger mt-1">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <!-- Bank Name -->
                            <div class="mb-3">
                                <label for="bank_account_name" class="form-label fw-semibold">Bank Name <span class="text-danger">*</span></label>
                                <input type="text" name="bank_account_name" id="bank_account_name"
                                    class="form-control rounded-3 @error('bank_account_name') is-invalid @enderror"
                                    value="{{ old('bank_account_name') }}" required>
                                @error('bank_account_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Bank Account Number -->
                            <div class="mb-4">
                                <label for="bank_account_number" class="form-label fw-semibold">Bank Account Number <span class="text-danger">*</span></label>
                                <input type="text" name="bank_account_number" id="bank_account_number"
                                    class="form-control rounded-3 @error('bank_account_number') is-invalid @enderror"
                                    value="{{ old('bank_account_number') }}" required>
                                @error('bank_account_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg rounded-3 shadow-sm">
                                    Register Now
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
