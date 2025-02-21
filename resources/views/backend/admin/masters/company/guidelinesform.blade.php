@extends('backend.layout.app')
@section('title', 'Company Guidelines')

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
                    Add Company Guidelines
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('guidelines.store') }}" method="POST"
                    class="row g-3 needs-validation company-guidelines-form" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Guideline Name -->
                    <x-input name="name" label="Guideline Name" required="true" validation="required|string|max:255" />

                    <!-- Description (Summernote) -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" class="summernote-editor">{{ old('description') }}</textarea>
                        <input type="hidden" name="description" id="description_input">
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Description is required.</div>
                    </div>

                    <!-- Upload File/Image -->
                    <x-input name="guideline_file" label="Upload File / Image" type="file" accept="image/*, .pdf, .docx"
                        required="true" validation="required" />

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Guidelines</button>
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
<script src="{{ asset('backend/assets/js/summernote.js') }}"></script>

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
        initValidation(".company-guidelines-form", {
            name: "required|string|max:255",
            description: "nullable|string",
            guideline_file: "required"
        });
    });
</script>
@endsection