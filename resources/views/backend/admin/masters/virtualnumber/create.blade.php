@extends('backend.layout.app')
@section('title', 'Manage Virtual Numbers')

@section('styleslinks')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- Tags Input CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<!-- Custom Styles -->
<style>
    .bootstrap-tagsinput {
        width: 100%;
        min-height: 38px;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {!! session('success') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Manage Virtual Numbers
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('storeVMN') }}" method="POST"
                    class="row g-3 needs-validation virtual-number-form" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Title -->

                    <!-- Select Action: Insert or Delete -->
                    <div class="col-md-6">
                        <label for="action" class="form-label">Select Action</label>
                        <select id="action" name="action" class="form-control" required>
                            <option value="">Select Action</option>
                            <option value="insert">Insert</option>
                            <option value="delete">Delete</option>
                        </select>
                        @error('action')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Select Input Method -->
                    <div class="col-md-6">
                        <label for="input_method" class="form-label">Input Method</label>
                        <select id="input_method" name="input_method" class="form-control" required>
                            <option value="">Select Method</option>
                            <option value="manual">Manually Add Numbers</option>
                            <option value="file">Upload CSV/Excel</option>
                        </select>
                        @error('input_method')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tags Input for Virtual Numbers -->
                    <div class="col-md-12" id="tags_input_section" style="display: none;">
                        <label for="virtual_numbers" class="form-label">Virtual Numbers</label>
                        <input type="text" id="virtual_numbers" name="virtual_numbers" class="form-control"
                            data-role="tagsinput" placeholder="Add numbers separated by commas or Enter" />
                        @error('virtual_numbers')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Upload Section -->
                    <div class="col-md-12" id="file_upload_section" style="display: none;">
                        <label for="file" class="form-label">Upload CSV/Excel</label>
                        <input type="file" id="file" name="file" class="form-control" accept=".csv,.xlsx">
                        @error('file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Process</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptslinks')
<!-- jQuery (Required for Tags Input) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Tags Input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<!-- Client-Side Validation -->
<script src="{{ asset('custom/validation.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#input_method').on('change', function() {
            let selected = $(this).val();

            if (selected === 'manual') {
                $('#tags_input_section').show();
                $('#file_upload_section').hide();
                $('#virtual_numbers').prop('disabled', false);
                $('#file').prop('disabled', true);
            } else if (selected === 'file') {
                $('#tags_input_section').hide();
                $('#file_upload_section').show();
                $('#virtual_numbers').prop('disabled', true);
                $('#file').prop('disabled', false);
            } else {
                $('#tags_input_section, #file_upload_section').hide();
                $('#virtual_numbers, #file').prop('disabled', false);
            }
        });

        // Ensure tag box opens if there is an error
        if ("{{ $errors->has('virtual_numbers') }}") {
            $('#tags_input_section').show();
        }

        // Prevent adding invalid tags
        $('#virtual_numbers').on('beforeItemAdd', function(event) {
            let number = event.item.trim();

            // Ensure the number is exactly 10 digits and contains only numbers
            if (!/^\d{10}$/.test(number)) {
                event.cancel = true; // Prevent tag from being added
                alert("Each tag must contain exactly 10 digits.");
            }
        });

        // Prevent duplicate tags
        $('#virtual_numbers').on('itemAdded', function(event) {
            let allTags = $('#virtual_numbers').val().split(',').map(n => n.trim());

            if (allTags.filter(n => n === event.item).length > 1) {
                alert("Duplicate virtual numbers are not allowed.");
                $('#virtual_numbers').tagsinput('remove', event.item); // Remove duplicate tag
            }
        });

        // Custom client-side validation before submitting the form
        $('.virtual-number-form').on('submit', function(event) {
            let inputMethod = $('#input_method').val();
            let numbers = $('#virtual_numbers').val().split(',').map(n => n.trim()).filter(n => n !== "");
            let fileInput = $('#file').val();

            // If manual input is selected, ensure at least one valid number
            if (inputMethod === 'manual' && numbers.length === 0) {
                alert("Please enter at least one valid virtual number.");
                event.preventDefault();
                return false;
            }

            // Ensure all numbers are exactly 10 digits when using manual input
            if (inputMethod === 'manual' && numbers.some(n => !/^\d{10}$/.test(n))) {
                alert("All virtual numbers must contain exactly 10 digits.");
                event.preventDefault();
                return false;
            }

            // If file input is selected, ensure a file is uploaded
            if (inputMethod === 'file' && !fileInput) {
                alert("Please upload a valid CSV or Excel file.");
                event.preventDefault();
                return false;
            }
        });

        // Initialize Validation (Ensure required rule applies only when needed)
        initValidation(".virtual-number-form", {
            action: "required|in:insert,delete",
            input_method: "required|in:manual,file",
            virtual_numbers: {
                required: function() {
                    return $('#input_method').val() === 'manual';
                }
            },
            file: {
                required: function() {
                    return $('#input_method').val() === 'file';
                }
            }
        });
    });
</script>


@endsection