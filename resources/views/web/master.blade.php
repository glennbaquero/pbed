<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    
	@if (auth()->guard('web')->check() &&  $checker->route->areOnRoutes([
	'web.sample-items.index',
	'web.contact-information.index',
	'web.contact-informations.show',
	]))
	    @include('admin.partials.styles')
	@else
		@include('partials.styles')
	@endif
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
</script> 
</head>
<body class="{{ !empty($frm_body) ? $frm_body : '' }}">
    
    <div id="app" class="wrapper">
    	@if (auth()->guard('web')->check() &&  $checker->route->areOnRoutes([
        	'web.sample-items.index',
        	'web.contact-information.index',
        	'web.contact-information.show',
 		]))
            @include('web.partials.sidebar')
            @yield('content')
		@else
        	@include('web.partials.header')
        	@yield('content')
        	@include('web.partials.footer')
        @endif

    </div>

    @include('partials.script-tags')

</body>
</html>