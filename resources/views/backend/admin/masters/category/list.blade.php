@extends('backend.layout.app')
@section('title', 'Category List')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="page-title">Category List <span
                                class="count-title">{{ $categories instanceof \Illuminate\Pagination\LengthAwarePaginator ? $categories->total() : count($categories) }}</span>
                        </h4>
                    </div>
                    <div class="col-4 text-end">
                        <div class="head-icons">
                            <a href="{{ route('categoryView') }}" data-bs-toggle="tooltip" title="Refresh"><i
                                    class="ti ti-refresh-dot"></i></a>
                            <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Collapse"
                                id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form action="{{ route('categoryView') }}" method="GET" class="icon-form w-50">
                        <span class="form-icon"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Search Categories">
                    </form>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('categoryForm') }}" class="btn btn-primary me-2"><i
                                class="ti ti-square-rounded-plus"></i> Add Category</a>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Export
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"
                                        onclick="exportTableToExcel('categoryTable')">Export Excel</a></li>
                                <li><a class="dropdown-item" href="#" onclick="exportTableToPDF('categoryTable')">Export
                                        PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="categoryTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <a
                                            href="{{ route('categoryView', ['sort' => 'status', 'direction' => ($sortColumn == 'status' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                                            Name
                                            @if($sortColumn == 'status')
                                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th><a
                                            href="{{ route('categoryView', ['sort' => 'cate_name', 'direction' => ($sortColumn == 'cate_name' && $sortDirection == 'asc') ? 'desc' : 'asc', 'per_page' => $perPage]) }}">
                                            Status
                                            @if($sortColumn == 'cate_name')
                                            <i class="ri-arrow-{{ $sortDirection == 'asc' ? 'up' : 'down' }}-line"></i>
                                            @endif
                                        </a></th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->cate_name }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $category->status ? 'bg-success' : 'bg-light text-dark' }}">
                                            {{ $category->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('category.edit', $category->cate_id) }}"
                                            class="text-info me-2"><i class="ti ti-edit"></i></a>
                                        <form action="{{ route('category.destroy', $category->cate_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0"
                                                onclick="return confirm('Are you sure?')"><i
                                                    class="ti ti-trash"></i></button>
                                        </form>
                                        <form action="{{ route('category.toggleStatus', $category->cate_id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-link text-warning p-0">
                                                <i
                                                    class="ti {{ $category->status ? 'ti-toggle-on' : 'ti-toggle-off' }}">
                                                </i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Left Side: Pagination -->
                            <div>
                                @if ($perPage != 'all')
                                <nav>
                                    <ul class="pagination pagination-sm mb-0">
                                        @if ($categories->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Prev</span></li>
                                        @else
                                        <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}">Prev</a></li>
                                        @endif

                                        @foreach ($categories->links()->elements[0] as $page => $url)
                                        @if ($page == $categories->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @elseif ($page == 1 || $page == $categories->lastPage() || abs($page - $categories->currentPage()) < 2)
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @elseif ($page == 2 || $page == $categories->lastPage() - 1)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            @endforeach

                                            @if ($categories->hasMorePages())
                                            <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a></li>
                                            @else
                                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                                            @endif
                                    </ul>
                                </nav>
                                @endif
                            </div>

                            <!-- Right Side: Entries Selector -->
                            <div>
                                <form method="GET" action="{{ route('categoryView') }}" id="perPageForm" class="d-flex align-items-center">
                                    <label for="perPage" class="me-2">Show:</label>
                                    <select name="per_page" id="perPage" class="form-select form-select-sm w-auto"
                                        onchange="document.getElementById('perPageForm').submit();">
                                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                        <option value="all" {{ $perPage == 'all' ? 'selected' : '' }}>All</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!-- Export Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    function exportTableToExcel(tableID) {
        var wb = XLSX.utils.table_to_book(document.getElementById(tableID), {
            sheet: "Sheet JS"
        });
        XLSX.writeFile(wb, 'Category_List.xlsx');
    }

    function exportTableToPDF(tableID) {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();
        doc.autoTable({
            html: `#${tableID}`
        });
        doc.save('Category_List.pdf');
    }
</script>

@endsection
