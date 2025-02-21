@extends('backend.layout.app')
@section('title', 'Category Form')

@section('styleslinks')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.note-editor.fullscreen {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1050;
    /* Make sure it's above other elements */
    background: white;
    overflow: auto;
}

.note-editor.fullscreen .note-editable {
    height: calc(100vh - 120px) !important;
    /* Adjust this based on toolbar height */
    overflow: auto;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add New Category
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST" class="needs-validation category-form"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Category Name -->
                    <x-input name="category_name" label="Category Name" required="true"
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

                    <!-- Upload Image -->
                    <x-input type="file" name="category_image" label="Upload Image" validation="nullable" />

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Category</button>
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
<script src="{{ asset('custom/validation.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    $('.summernote-editor').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onChange: function(contents) {
                document.querySelector("#description_input").value = contents.trim();
                validateField(document.querySelector("#description_input"), {
                    description: "nullable|string"
                });
            },
            onFullscreen: function(isFullscreen) {
                if (isFullscreen) {
                    $('.note-editor').addClass('fullscreen');
                } else {
                    $('.note-editor').removeClass('fullscreen');
                }
            }
        }
    });


    initValidation(".category-form", {
        category_name: "required|string|max:255",
        description: "nullable|string",
        category_image: "nullable"
    });
});
</script>
@endsection