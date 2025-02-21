<!-- jQuery -->
<!-- jQuery (First) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Feather Icon JS -->
<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

<!-- Datatable JS -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Daterangepicker JS -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Apexchart JS -->
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

<!-- Custom JSON JS -->
<script src="{{ asset('assets/js/jsonscript.js') }}"></script>

<!-- Conditional Theme Script -->
@php
$excludedPages = [
'register', 'reset-password', 'two-step-verification', 'under-maintenance',
'error-404', 'error-500', 'blank-page', 'coming-soon', 'login',
'forgot-password', 'email-verification', 'lock-screen', 'success'
];
@endphp

@if (!in_array(Route::currentRouteName(), $excludedPages))
<!-- Theme Script -->
<script src="{{ asset('assets/js/theme-script.js') }}"></script>
@endif

<!-- Custom JS -->
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('scriptslinks')
