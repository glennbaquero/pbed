<aside class="main-sidebar sidebar-dark-danger">
    <a href="{{ route('web.dashboard') }}" class="brand-link">
        @include('partials.brand')
    </a>

    <div class="sidebar">
        @if (auth()->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $self->renderAvatar() }}" class="img-circle" style="width: 40px; height: 40px;">
                </div>
                <div class="info">
                    <p class="d-block fntwght--bold type-white">{{ $self->renderName() }}</p>
                    {{-- <h6 class="type-white mb-0">Tier 1</h6> --}}
                </div>
            </div>
        @endif

        <div class="frm-sidebar__main-nav">
            <p>MAIN NAVIGATION</p>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('web.contact-information.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'web.contact-information.index',
                            'web.contact-information.show',
                    ]) }}">                    
                        <i class="nav-icon fa fa-folder"></i>
                        <p>
                            Contact Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web.profiles.show') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'web.profiles.show',
                    ]) }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>My Account</p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</aside>