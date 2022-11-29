<header id="header" class="header__con changeHeader" >
    <div class="hdr__spacing"></div>
    <div class="position-fixed fixed-top hdr__innerCon">
        <div class="width--90 margin-a">
            <nav class="navbar navbar-expand-lg px-0">
                <a class="navbar-brand" href="/">
                    <img src="/images/pbed-logo-colored.svg">
                </a>
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse hdr__menu">
                
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.home' ]) }}">
                            <a class="nav-link" href="{{ route('web.home') }}">{{ $header['home'] }}</a>
                        </li>
                        <li class="nav-item dropdown {{ $checker->route->areOnRoutes([ 'web.areas-of-work.workforce', 'web.areas-of-work.teaching-and-learning' ]) }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $header['areas_of_work'] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('web.areas-of-work.workforce') }}">{{ $header['workforce_development'] }}</a>
                                <a class="dropdown-item" href="{{ route('web.areas-of-work.teaching-and-learning') }}">{{ $header['teaching_and_learning'] }}</a>
                            </div>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.organizations' ]) }}">
                            <a class="nav-link" href="{{ route('web.organizations') }}">{{ $header['organizations'] }}</a>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.projects', 'web.projects.show' ]) }}">
                            <a class="nav-link" href="{{ route('web.projects') }}">{{ $header['projects'] }}</a>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.youthworksph' ]) }}">
                            <a class="nav-link" href="{{ route('web.youthworksph') }}">{{ $header['youth_works_ph'] }}</a>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.news' ]) }}">
                            <a class="nav-link" href="{{ route('web.news') }}">{{ $header['news'] }}</a>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.blogs' ]) }}">
                            <a class="nav-link" href="{{ route('web.blogs') }}">{{ $header['blogs'] }}</a>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.careers' ]) }}">
                            <a class="nav-link" href="{{ route('web.careers') }}">{{ $header['careers'] }}</a>
                        </li>
                        <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.contact-us' ]) }}">
                            <a class="nav-link" href="{{ route('web.contact-us') }}">{{ $header['contact_us'] }}</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="header__mbl-con">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.home' ]) }}">
                <a class="nav-link" href="{{ route('web.home') }}">{{ $header['home'] }}</a>
            </li>

            <li class="nav-item accordion {{ $checker->route->areOnRoutes([ 'web.areas-of-work.workforce', 'web.areas-of-work.teaching-and-learning' ]) }}">
                <div class="accordion" id="accordionExample">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        {{ $header['areas_of_work'] }}
                        <i class="fa fa-caret-right"></i>
                    </a>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <a class="nav-link pl-4" href="{{ route('web.areas-of-work.workforce') }}">{{ $header['workforce_development'] }}</a>
                        <a class="nav-link pl-4" href="{{ route('web.areas-of-work.teaching-and-learning') }}">{{ $header['teaching_and_learning'] }}</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.organizations' ]) }}">
                <a class="nav-link" href="{{ route('web.organizations') }}">{{ $header['organizations'] }}</a>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.projects' ]) }}">
                <a class="nav-link" href="{{ route('web.projects') }}">{{ $header['projects'] }}</a>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.youthworksph' ]) }}">
                <a class="nav-link" href="{{ route('web.youthworksph') }}">{{ $header['youth_works_ph'] }}</a>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.news' ]) }}">
                <a class="nav-link" href="{{ route('web.news') }}">{{ $header['news'] }}</a>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.blogs' ]) }}">
                <a class="nav-link" href="{{ route('web.blogs') }}">{{ $header['blogs'] }}</a>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.careers' ]) }}">
                <a class="nav-link" href="{{ route('web.careers') }}">{{ $header['careers'] }}</a>
            </li>
            <li class="nav-item {{ $checker->route->areOnRoutes([ 'web.contact-us' ]) }}">
                <a class="nav-link" href="{{ route('web.contact-us') }}">{{ $header['contact_us'] }}</a>
            </li>
            <div class="my-3"></div>
            <li class="nav-item">
                <a target="_blank" class="nav-link fntwght--regular" href="mailto:{{ $home['pageItems']['home_contact_us_email'] }}"><img class="mr-2 icon" src="/images/icons/email.png">{{ $home['pageItems']['home_contact_us_email'] }}</a>
            </li>
            <li class="nav-item">
                <a target="_blank" class="nav-link fntwght--regular" href="tel:{{ $home['pageItems']['home_contact_us_contact_number'] }}"><img class="mr-2 icon" src="/images/icons/phone.png">{{ $home['pageItems']['home_contact_us_contact_number'] }}</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link fntwght--regular" href="#"><img class="mr-2 icon" src="/images/icons/phone.png">(02) 728-2031</a>
            </li> --}}

        </ul>

    </div>
</header>