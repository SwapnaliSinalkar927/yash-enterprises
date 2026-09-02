<!DOCTYPE html>
<html>
<head>
    @include('web.includes.header')
    @yield('style')
</head>
<body class="custom-cursor">
    @include('web.includes.navbar')
    @yield('content')
    @include('web.includes.footer')
    @yield('script')
</body>
</html>
