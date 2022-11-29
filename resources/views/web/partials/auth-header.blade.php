@if(Auth::check())
<nav class="main-header navbar navbar-expand frm-header">
    <ul class="navbar-nav ml-auto">
        <li class="d-none d-sm-inline-block">
            <a class="text-white frm-main__header" href="{{ route('web.logout') }}">Logout</a>
        </li>
    </ul>
</nav>
@endif