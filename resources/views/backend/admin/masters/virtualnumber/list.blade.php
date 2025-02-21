@extends('backend.layout.app')
@section('title', 'Virtual Numbers Records')
@section('content')

<div class="container">
    <h2>Virtual Numbers Records</h2>

    <!-- Search, Sorting & Pagination Length -->
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('viewVirtualNumbers') }}" method="GET" class="d-flex">
            <!-- Search Criteria Dropdown -->
            <select name="search_by" class="form-select me-2">
                <option value="Company_Name" {{ request('search_by') == 'Company_Name' ? 'selected' : '' }}>Company Name
                </option>
                <option value="Forwarding_Number" {{ request('search_by') == 'Forwarding_Number' ? 'selected' : '' }}>
                    Forwarding Number</option>
                <option value="Whatsapp_Number" {{ request('search_by') == 'Whatsapp_Number' ? 'selected' : '' }}>
                    WhatsApp Number</option>
                <option value="callNumber" {{ request('search_by') == 'callNumber' ? 'selected' : '' }}>Call Number
                </option>
                <option value="Virtual_Number" {{ request('search_by') == 'Virtual_Number' ? 'selected' : '' }}>Virtual
                    Number</option>
                <option value="Status" {{ request('search_by') == 'Status' ? 'selected' : '' }}>Status</option>
                <option value="orderID" {{ request('search_by') == 'orderID' ? 'selected' : '' }}>Order ID</option>
            </select>

            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                placeholder="Search records">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <form action="{{ route('viewVirtualNumbers') }}" method="GET">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Complete</option>
            </select>
        </form>
    </div>

    <!-- Virtual Numbers Table -->
    <div class="table-responsive">
        <table id="virtualRecordsTable" class="table text-nowrap table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>
                        <a
                            href="{{ route('viewVirtualNumbers', ['sort' => 'Virtual_Number', 'direction' => ($sortColumn == 'Virtual_Number' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Virtual Number
                            @if($sortColumn == 'Virtual_Number')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('viewVirtualNumbers', ['sort' => 'Company_Name', 'direction' => ($sortColumn == 'Company_Name' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Company Name
                            @if($sortColumn == 'Company_Name')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>Forwarding Number</th>
                    <th>WhatsApp Number</th>
                    <th>Call Number</th>
                    <th>
                        <a
                            href="{{ route('viewVirtualNumbers', ['sort' => 'Status', 'direction' => ($sortColumn == 'Status' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                            Status
                            @if($sortColumn == 'Status')
                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                            @endif
                        </a>
                    </th>
                    <th>Order Id</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($virtualNumbers as $record)

                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->Virtual_Number ?? 'Not Available' }}</td>

                <td>{{ $record->Company_Name ?? 'Company Name Not Mentioned' }}</td>
                <td>{{ $record->Forwarding_Number ?? 'Not Provided' }}</td>
                <td>{{ $record->Whatsapp_Number ?? 'Not Available' }}</td>
                <td>{{ $record->callNumber ?? 'N/A' }}</td>

                <td>
                    <span class="badge {{ $record->Status['class'] }}">
                        {{ $record->Status['label'] ?? 'Unknown' }}
                    </span>
                </td>



                <td>{{ $record->orderID ?? 'No Order ID' }}</td>


                <td class="d-flex align-items-center">
                    <!-- Edit Icon -->
                    <a href="{{ route('virtualRecord.edit', $record->id) }}" class="text-info me-3"
                        style="font-size: 1.5rem;">
                        <i class="ri-edit-line"></i>
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('virtualRecord.destroy', $record->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-danger border-0 bg-transparent" style="font-size: 1.5rem;"
                            onclick="return confirm('Are you sure?')">
                            <i class="ri-delete-bin-5-line"></i>
                        </button>
                    </form>

                    <!-- Status Toggle Form -->
                    <form action="{{ route('virtualRecord.toggleStatus', $record->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="border-0 bg-transparent text-warning ms-3"
                            style="font-size: 1.5rem;">
                            @if($record->Status == 'Active')
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
        {{ $virtualNumbers->appends(request()->query())->links() }}
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
    var table = $('#virtualRecordsTable').DataTable({
        paging: false, // Keep Laravel pagination
        searching: false, // Keep Laravel search
        ordering: false, // Keep Laravel sorting
        info: false, // Keep Laravel pagination info
        dom: 'Bfrtip',
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