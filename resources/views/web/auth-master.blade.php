<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    {{-- @include('admin.partials.styles') --}}
    @include('partials.styles')

</head>
<body class="">
    
    <div id="app">

        @yield('content')
        
    </div>

    @include('partials.script-tags')

</body>
</html>