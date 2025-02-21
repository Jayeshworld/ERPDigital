@extends('backend.layout.app')
@section('title', 'Edit Package')

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
                    Edit Package
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('package.update', $package->id) }}" method="POST"
                    class="row g-3 needs-validation package-form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Package Name -->
                    <div class="col-md-12">
                        <label for="package_name" class="form-label">Package Name</label>
                        <input type="text" class="form-control @error('package_name') is-invalid @enderror"
                            id="package_name" name="package_name"
                            value="{{ old('package_name', $package->package_name) }}" placeholder="Enter package name"
                            required>
                        @error('package_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Threshold -->
                    <div class="col-md-6">
                        <label for="package_thrashold" class="form-label">Threshold</label>
                        <input type="number" class="form-control @error('package_thrashold') is-invalid @enderror"
                            id="package_thrashold" name="package_thrashold"
                            value="{{ old('package_thrashold', $package->package_thrashold) }}" min="0" required>
                        @error('package_thrashold')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- HSN Code -->
                    <div class="col-md-6">
                        <label for="HSN" class="form-label">HSN Code</label>
                        <input type="text" class="form-control @error('HSN') is-invalid @enderror" id="HSN" name="HSN"
                            value="{{ old('HSN', $package->HSN) }}" required>
                        @error('HSN')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description (Summernote) -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description"
                            class="summernote-editor">{{ old('description', $package->package_descript) }}</textarea>
                        <input type="hidden" name="description" id="description_input">
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" {{ $package->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $package->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Package</button>
                        <a href="{{ route('viewPackage') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptslinks')
<!-- jQuery (Required for Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- Custom Summernote Initialization -->
<script src="{{ asset('backend/assets/summernote.js') }}"></script>

<!-- Client-Side Validation -->
<script src="{{ asset('custom/validation.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Summernote
    $('.summernote-editor').summernote({
        height: 200,
        callbacks: {
            onChange: function(contents) {
                document.querySelector("#description_input").value = contents.trim();
                validateField(document.querySelector("#description_input"), {
                    description: "nullable|string"
                });
            }
        }
    });

    // Initialize Validation
    initValidation(".package-form", {
        package_name: "required|string|max:255",
        package_thrashold: "required|numeric|min:0",
        HSN: "required|string|max:255",
        description: "nullable|string",
        status: "required|integer"
    });
});
</script>
@endsection