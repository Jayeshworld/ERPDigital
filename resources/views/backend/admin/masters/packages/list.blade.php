@extends('backend.layout.app')
@section('title', 'Package Details')
@section('content')

<div class="container">
    <h2>Package Details</h2>

    <!-- Search, Sorting & Pagination Length -->
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('viewPackage') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                placeholder="Search by package name">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <form action="{{ route('viewPackage') }}" method="GET">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Complete</option>
            </select>
        </form>
    </div>

    <!-- Package Table -->
    <div class="table-responsive">
        <table id="packageTable" class="table text-nowrap table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>
                        <a
                            href="{{ route('viewPackage', ['sort' => 'package_name', 'direction' => ($sortColumn == 'package_name' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Package Name
                            @if($sortColumn == 'package_name')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>Threshold</th>
                    <th>Description</th>
                    <th>
                        <a
                            href="{{ route('viewPackage', ['sort' => 'status', 'direction' => ($sortColumn == 'status' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Status
                            @if($sortColumn == 'status')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>HSN</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->package_name }}</td>
                    <td>{{ $package->package_thrashold }}</td>
                    <td>{{ Str::limit($package->package_descript, 50) }}</td>
                    <td>
                        <span class="badge {{ $package->status ? 'bg-success' : 'bg-light text-dark' }}">
                            {{ $package->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $package->HSN }}</td>
                    <td class="d-flex align-items-center">
                        <!-- Edit Icon -->
                        <a href="{{ route('package.edit', $package->id) }}" class="text-info me-3"
                            style="font-size: 1.5rem;">
                            <i class="ri-edit-line"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('package.destroy', $package->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger border-0 bg-transparent" style="font-size: 1.5rem;"
                                onclick="return confirm('Are you sure?')">
                                <i class="ri-delete-bin-5-line"></i>
                            </button>
                        </form>

                        <!-- Status Toggle Form -->
                        <form action="{{ route('package.toggleStatus', $package->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="border-0 bg-transparent text-warning ms-3"
                                style="font-size: 1.5rem;">
                                @if($package->status)
                                <i class="ri-toggle-fill"></i> <!-- Active (Toggle On) -->
                                @else
                                <i class="ri-toggle-line"></i> <!-- Inactive (Toggle Off) -->
                                @endif
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
        {{ $packages->appends(request()->query())->links() }}
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
    var table = $('#packageTable').DataTable({
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