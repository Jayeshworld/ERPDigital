@extends('backend.layout.app')
@section('title', 'Edit Category')

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
                    Edit Category
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->cate_id) }}" method="POST"
                    class="needs-validation category-form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="cate_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('cate_name') is-invalid @enderror" id="cate_name"
                            name="cate_name" value="{{ old('cate_name', $category->cate_name) }}"
                            placeholder="Enter category name" required>
                        @error('cate_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description (Summernote Editor) -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description"
                            class="summernote-editor">{{ old('description', $category->cate_descript) }}</textarea>
                        <input type="hidden" name="description" id="description_input">
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback d-none">Description is required.</div>
                    </div>

                    <!-- Upload Image with Preview -->
                    <div class="mb-3">
                        <label for="category_image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="category_image" name="category_image"
                            accept="image/*" onchange="previewImage(event)">
                        <div class="mt-2">
                            @if($category->cate_img_loc)
                            <img id="imagePreview" src="{{ asset('storage/' . $category->cate_img_loc) }}"
                                alt="Current Image" width="100">
                            @else
                            <img id="imagePreview" src="" alt="Image Preview" width="100" style="display:none;">
                            @endif
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="{{ route('categoryView') }}" class="btn btn-secondary">Cancel</a>
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
<script src="{{ asset('backend/assets/summernote.js') }}"></script>
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

    initValidation(".category-form", {
        cate_name: "required|string|max:255",
        description: "nullable|string",
        category_image: "nullable",
        status: "required|integer"
    });
});

function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function() {
        let img = document.getElementById('imagePreview');
        img.src = reader.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection