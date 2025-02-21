@extends('backend.layout.app')
@section('title', 'Edit Virtual Number')

@section('styleslinks')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Edit Virtual Number
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('virtual.update', $virtual->id) }}" method="POST"
                    class="row g-3 needs-validation virtual-form" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Virtual Number -->
                    <div class="col-md-6">
                        <label for="virtual_number" class="form-label">Virtual Number</label>
                        <input type="text" class="form-control @error('virtual_number') is-invalid @enderror"
                            id="virtual_number" name="virtual_number"
                            value="{{ old('virtual_number', $virtual->Virtual_Number) }}" required>
                        @error('virtual_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Logedin by -->
                    <div class="col-md-6">
                        <label for="logedin_by" class="form-label">Logedin By</label>
                        <input type="text" class="form-control @error('logedin_by') is-invalid @enderror"
                            id="logedin_by" name="logedin_by" value="{{ old('logedin_by', $virtual->User_Login_ID) }}">
                        @error('logedin_by')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div class="col-md-6">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                            id="company_name" name="company_name"
                            value="{{ old('company_name', $virtual->Company_Name) }}">
                        @error('company_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Forwarding Number -->
                    <div class="col-md-6">
                        <label for="forwarding_number" class="form-label">Forwarding Number</label>
                        <input type="text" class="form-control @error('forwarding_number') is-invalid @enderror"
                            id="forwarding_number" name="forwarding_number"
                            value="{{ old('forwarding_number', $virtual->Forwarding_Number) }}">
                        @error('forwarding_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="col-md-6">
                        <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                        <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror"
                            id="whatsapp_number" name="whatsapp_number"
                            value="{{ old('whatsapp_number', $virtual->Whatsapp_Number) }}">
                        @error('whatsapp_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Call Number -->
                    <div class="col-md-6">
                        <label for="call_number" class="form-label">Call Number</label>
                        <input type="text" class="form-control @error('call_number') is-invalid @enderror"
                            id="call_number" name="call_number" value="{{ old('call_number', $virtual->callNumber) }}">
                        @error('call_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- order id -->
                    <div class="col-md-6">
                        <label for="order_id" class="form-label">Order Id</label>
                        <input type="text" class="form-control @error('order_id') is-invalid @enderror" id="order_id"
                            name="order_id" value="{{ old('order_id', $virtual->orderID) }}">
                        @error('order_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>



                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Active" {{ $virtual->Status['label'] == 'Active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="Closed" {{ $virtual->Status['label'] == 'Closed' ? 'selected' : '' }}>Closed
                            </option>
                            <option value="On Hold" {{ $virtual->Status['label'] == 'On Hold' ? 'selected' : '' }}>On
                                Hold
                            </option>
                            <option value="Inforce" {{ $virtual->Status['label'] == 'Inforce' ? 'selected' : '' }}>
                                Inforce
                            </option>
                            <option value="Available" {{ $virtual->Status['label'] == 'Available' ? 'selected' : '' }}>
                                Available
                            </option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Virtual Number</button>
                        <a href="{{ route('viewVirtualNumbers') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptslinks')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Client-Side Validation -->
<script src="{{ asset('custom/validation.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Validation
    initValidation(".virtual-form", {
        virtual_number: "required|string|max:255",
        company_name: "nullable|string|max:255",
        forwarding_number: "nullable|string|max:255",
        whatsapp_number: "nullable|string|max:255",
        call_number: "nullable|string|max:255",
        status: "required|string"
    });
});
</script>
@endsection