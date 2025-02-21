@extends('backend.layout.app')
@section('title', 'OTP Records')

@section('content')

<div class="container">
    <h2>OTP Records</h2>

    <!-- Filters: Mobile Number & Date Range -->
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('otpDetails') }}" method="GET" class="d-flex">
            <!-- Mobile Number Filter -->
            <input type="text" name="mobile" value="{{ request('mobile') }}" class="form-control me-2"
                placeholder="Filter by Mobile Number">

            <!-- Date-Time From -->
            <input type="datetime-local" name="from" value="{{ request('from') }}" class="form-control me-2">

            <!-- Date-Time To -->
            <input type="datetime-local" name="to" value="{{ request('to') }}" class="form-control me-2">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <!-- OTP Records Table -->
    <div class="table-responsive">
        <table id="otpTable" class="table text-nowrap table-bordered">
            <thead>
                <tr>
                    <th>SR</th>
                    <th>Mobile Number</th>
                    <th>OTP</th>
                    <th>Requested Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($otpRecords as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->Mobile_NO }}</td>
                    <td>{{ $record->OTP }}</td>
                    <td>{{ $record->cate_UpdatedDate }}</td>
                    <td>{{ $record->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $otpRecords->appends(request()->query())->links() }}
    </div>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#otpTable').DataTable({
            paging: false, // Keep Laravel pagination
            searching: false, // Keep Laravel search
            ordering: false, // Keep Laravel sorting
            info: false // Hide extra DataTables info
        });
    });
</script>

@endsection