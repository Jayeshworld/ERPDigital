@extends('backend.layout.app')
@section('title', 'Edit Guideline')

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
                    Edit Guideline
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('guidelines.update', $guideline->id) }}" method="POST"
                    class="needs-validation guideline-form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('name', $guideline->title) }}" placeholder="Enter title"
                            required>
                        @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Guidelines Description (Summernote Editor) -->
                    <div class="mb-3">
                        <label for="guidelines" class="form-label">Guidelines</label>
                        <textarea id="guidelines"
                            class="summernote-editor">{{ old('guidelines', $guideline->guidelines) }}</textarea>
                        <input type="hidden" name="guidelines" id="guidelines_input">
                        @error('guidelines')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload File -->
                    <div class="mb-3">
                        <label for="guideline_file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="guideline_file" name="guideline_file"
                            accept="image/*, .pdf, .docx" onchange="previewFile(event)">
                        <div class="mt-2">
                            @if($guideline->fileName)
                            <p>Current File: <a href="{{ asset('storage/' . $guideline->fileName) }}" target="_blank">
                                    View File</a></p>
                            @if (Str::endsWith($guideline->fileName, ['.jpg', '.jpeg', '.png', '.gif', '.pdf']))
                            <embed id="filePreview" src="{{ asset('storage/' . $guideline->fileName) }}" width="100">
                            @endif
                            @else
                            <embed id="filePreview" src="" width="100" style="display:none;">
                            @endif
                        </div>
                    </div>

                    <!-- Updated By (Auto-filled) -->
                    <div class="mb-3">
                        <label for="updatedBy" class="form-label">Updated By</label>
                        <input type="text" class="form-control" id="updatedBy" name="updatedBy"
                            value="{{ $guideline->updatedBy ?? 'Unknown' }}" readonly>
                    </div>

                    <!-- Status -->


                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Guideline</button>
                        <a href="{{ route('viewGuidelines') }}" class="btn btn-secondary">Cancel</a>
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
                document.querySelector("#guidelines_input").value = contents.trim();
                validateField(document.querySelector("#guidelines_input"), {
                    guidelines: "nullable|string"
                });
            }
        }
    });

    initValidation(".guideline-form", {
        title: "required|string|max:255",
        guidelines: "nullable|string",
        guideline_file: "nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:5048",
        status: "required|integer"
    });
});

function previewFile(event) {
    let file = event.target.files[0];
    let reader = new FileReader();
    reader.onload = function() {
        let filePreview = document.getElementById('filePreview');
        filePreview.src = reader.result;
        filePreview.style.display = 'block';
    };
    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>
@endsection