<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layout.head')
    <title>@yield('title', 'Login Page')</title>
</head>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-01">
                <div
                    class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="needs-validation flex-fill" novalidate>
                        @csrf
                        <div class="mx-auto mw-450">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                            </div>

                            <div class="mb-4">
                                <h4 class="mb-2 fs-20">Sign In</h4>
                                <p>Access the ERP panel using your email and password.</p>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Email Address</label>
                                <div class="position-relative">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="col-form-label">Password</label>
                                <div class="pass-group">
                                    <input type="password"
                                        class="pass-input form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    <span class="ti toggle-password ti-eye-off"></span>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="form-check form-check-md d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                <div class="text-end">

                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                            </div>

                            <!-- Copyright -->
                            <div class="text-center">
                                <p class="fw-medium text-gray">Copyright &copy; {{ date('Y') }} - DigitalSochMedia ERP
                                </p>
                            </div>
                        </div>
                    </form>
                    <!-- End Login Form -->

                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- Validation Script -->
    <script src="{{ asset('assets/js/validation.init.js') }}"></script>

    <!-- JS Includes -->
    @include('backend.layout.scripts')
</body>

</html>