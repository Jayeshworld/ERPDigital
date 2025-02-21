<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-width="fullwidth" data-menu-styles="light" data-toggled="close">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@include('backend.layout.headl')

<body>
    @include('backend.layout.theamesetting')
    <div class="page">


        @include('backend.layout.header')
        @include('backend.layout.sidebar')
        @yield('content')
        @include('backend.layout.topbutton')

        @include('backend.layout.footer')
    </div>
    @include('backend.layout.scripts')
</body>

</html>