<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    @include('admin.partials.styles')
    {{-- @include('partials.styles') --}}

</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    
    <div id="app" class="wrapper">

        @include('web.partials.auth-header')
        @include('web.partials.sidebar')

        
        @yield('content')

    </div>

    @include('partials.script-tags')

</body>
</html>