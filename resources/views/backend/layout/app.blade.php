<!DOCTYPE html>
<html lang="en">

@include('backend.layout.head')

<body>
    <div class="main-wrapper">
        @include('backend.layout.loader')


        @include('backend.layout.header')
        @include('backend.layout.sidebar')
        <div class="page-wrapper">
            <div class="content">

                @yield('content')
            </div>
        </div>

    </div>
    @yield('scripts')
    @include('backend.layout.scripts')
</body>


</html>