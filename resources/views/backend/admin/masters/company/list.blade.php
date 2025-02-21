@extends('backend.layout.app')
@section('title', 'Guidelines List')
@section('content')

<div class="container">
    <h2>Guidelines List</h2>

    <!-- Search, Sorting & Pagination Length -->
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('viewGuidelines') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                placeholder="Search by title or updated by">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <form action="{{ route('viewGuidelines') }}" method="GET">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Complete</option>
            </select>
        </form>
    </div>

    <!-- Guidelines Table -->
    <div class="table-responsive">
        <table id="guidelinesTable" class="table text-nowrap table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>
                        <a
                            href="{{ route('viewGuidelines', ['sort' => 'title', 'direction' => ($sortColumn == 'title' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Title
                            @if($sortColumn == 'title')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>Guidelines</th>
                    <th>File</th>
                    <th>
                        <a
                            href="{{ route('viewGuidelines', ['sort' => 'updatedBy', 'direction' => ($sortColumn == 'updatedBy' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Updated By
                            @if($sortColumn == 'updatedBy')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guidelines as $guideline)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $guideline->title }}</td>
                    <td>{{ Str::limit($guideline->guidelines, 50) }}</td>
                    <td>
                        @if($guideline->fileName)
                        <a href="{{ asset('storage/' . $guideline->fileName) }}" target="_blank"
                            class="btn btn-info btn-sm">View File</a>
                        @else
                        No File
                        @endif
                    </td>
                    <td>{{ $guideline->updatedBy }}</td>
                    <td>{{ $guideline->updated_at }}</td>
                    <td class="d-flex align-items-center">
                        <!-- Edit Icon -->
                        <a href="{{ route('guidelines.edit', $guideline->id) }}" class="text-info me-3"
                            style="font-size: 1.5rem;">
                            <i class="ri-edit-line"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('guidelines.destroy', $guideline->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger border-0 bg-transparent" style="font-size: 1.5rem;"
                                onclick="return confirm('Are you sure?')">
                                <i class="ri-delete-bin-5-line"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination (Laravel) -->
    @if ($perPage !== 'all')
    <div class="d-flex justify-content-center">
        {{ $guidelines->appends(request()->query())->links() }}
    </div>
    @endif

</div>

<!-- DataTables Scripts for Exporting Only -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#guidelinesTable').DataTable({
        paging: false, // Keep Laravel pagination
        searching: false, // Keep Laravel search
        ordering: false, // Keep Laravel sorting
        info: false, // Keep Laravel pagination info
        dom: 'Bfrtip', // This automatically adds the buttons
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'csvHtml5',
                text: 'Export to CSV',
                className: 'btn btn-info'
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-dark'
            }
        ]
    });
});
</script>

@endsection