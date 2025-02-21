@extends('backend.layout.app')
@section('title', 'Designation Form')

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
                    Add New Designation
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('designation.store') }}" method="POST" class="needs-validation designation-form"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Designation Name -->
                    <x-input name="name" label="Designation Name" required="true"
                        validation="required|string|max:255" />

                    <!-- Description (Summernote Editor) -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" class="summernote-editor">{{ old('description') }}</textarea>
                        <input type="hidden" name="description" id="description_input">
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback d-none">Description is required.</div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Designation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptslinks')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="{{ asset('backend/assets/js/summernote.js') }}"></script>
<script src="{{ asset('custom/validation.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        initValidation(".designation-form", {
            name: "required|string|max:255",
            description: "nullable|string",
            status: "required|string"
        });
    });
</script>
@endsection