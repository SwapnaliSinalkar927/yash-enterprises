<!DOCTYPE html>
<html>
<head>
    @include('admin.includes.head')
    @yield('style')
</head>
<body>
    @include('admin.includes.nav')
    @include('admin.includes.sidenav')
    @yield('content')
    @include('admin.includes.footer')
    @yield('script')
    @include('admin.includes.datatable_script')
</body>
</html>
