
<aside class="main-sidebar sidebar-light-danger">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        @include('partials.brand')
    </a>

    <div class="sidebar scroll-custom">
        @if (auth()->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $self->renderAvatar() }}" class="img-circle" style="width: 40px; height: 40px;">
                </div>
                <div class="info">
                    <p class="d-block fntwght--bold type-1">
                        <a href="{{ route('admin.profiles.show') }}" class="d-block">
                            {{ auth()->guard('admin')->user()->renderFullName() }}
                        </a>
                    </p>
                    <h6 class="mb-0">Admin</h6>
                </div>
            </div>
        @endif

        <div class="frm-sidebar__main-nav light">
            <p>MAIN NAVIGATION</p>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.dashboard',
                    ]) }}">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li> --}}

                @if ($self->hasAnyPermission(['admin.pages.crud', 'admin.page-items.crud', 'admin.articles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.user-classifications.index','admin.user-classifications.create','admin.user-classifications.show',
                            'admin.users.index','admin.users.create','admin.users.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.users.index','admin.users.create','admin.users.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Users
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.user-classifications.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.user-classifications.index','admin.user-classifications.create','admin.user-classifications.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        User Classifications
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.pages.crud', 'admin.page-items.crud', 'admin.articles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.confidentiality-categories.index','admin.confidentiality-categories.create','admin.confidentiality-categories.show', 
                            'admin.contact-categories.index','admin.contact-categories.create','admin.contact-categories.show',
                            'admin.contact-informations.index','admin.contact-informations.create','admin.contact-informations.show', 
                            'admin.request-information.index','admin.request-information.create','admin.request-information.show'
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Contact Information Mgt.
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.confidentiality-categories.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.confidentiality-categories.index','admin.confidentiality-categories.create','admin.confidentiality-categories.show'
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Confidentiality Category
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <ul class="nav nav-treeview">
                            {{-- @if ($self->hasAnyPermission(['admin.users.crud'])) --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.contact-categories.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.contact-categories.index','admin.contact-categories.create','admin.contact-categories.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Contact Category
                                        </p>
                                    </a>
                                </li>
                            {{-- @endif --}}
                        </ul>
                        <ul class="nav nav-treeview">
                            {{-- @if ($self->hasAnyPermission(['admin.users.crud'])) --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.contact-informations.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.contact-informations.index','admin.contact-informations.create','admin.contact-informations.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Contact Information
                                        </p>
                                    </a>
                                </li>
                            {{-- @endif --}}
                        </ul>
                        <ul class="nav nav-treeview">
                            {{-- @if ($self->hasAnyPermission(['admin.users.crud'])) --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.request-information.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.request-information.index','admin.request-information.create','admin.request-information.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Contact Requests
                                        </p>
                                    </a>
                                </li>
                            {{-- @endif --}}
                        </ul>
                    </li>
                @endif
                
                @if ($self->hasAnyPermission(['admin.pages.crud', 'admin.page-items.crud', 'admin.articles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.home-first-frame.index','admin.home-first-frame.create','admin.home-first-frame.show',
                                'admin.home-latest-study.index','admin.home-latest-study.create','admin.home-latest-study.show',
                                'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                                'admin.advocacies.index','admin.advocacies.create','admin.advocacies.show',
                                'admin.news.index','admin.news.create','admin.news.show',
                                'admin.careers.index','admin.careers.create','admin.careers.show',
                                'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                'admin.events.index','admin.events.create','admin.events.show',
                                'admin.challenges.index','admin.challenges.create','admin.challenges.show',
                                'admin.solutions.index','admin.solutions.create','admin.solutions.show',
                                'admin.frame-four.index','admin.frame-four.create','admin.frame-four.show',
                                'admin.page-items.index','admin.page-items.create','admin.page-items.show',
                                'admin.pages.index','admin.pages.create','admin.pages.show',
                                'admin.news.index','admin.news.create','admin.news.show',
                                'admin.projects.index','admin.projects.create','admin.projects.show',
                                'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                'admin.youthwork-first-frame.index','admin.youthwork-first-frame.create','admin.youthwork-first-frame.show',
                                'admin.youth-works-courses.index','admin.youth-works-courses.create','admin.youth-works-courses.show',
                                'admin.youth-works-teams.index','admin.youth-works-teams.create','admin.youth-works-teams.show',
                                'admin.youth-works-videos.index','admin.youth-works-videos.create','admin.youth-works-videos.show',
                                'admin.project-priority-areas.index','admin.project-priority-areas.create','admin.project-priority-areas.show',
                                'admin.growth-sectors.index','admin.growth-sectors.create','admin.growth-sectors.show',
                                'admin.faqs.index','admin.faqs.create','admin.faqs.show',
                                'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                'admin.our-leaderships.index','admin.our-leaderships.create','admin.our-leaderships.show',
                                'admin.advisers.index','admin.advisers.create','admin.advisers.show',
                                'admin.members.index','admin.members.create','admin.members.show',
                                'admin.our-people.index','admin.our-people.create','admin.our-people.show',
                                'admin.careers.index','admin.careers.create','admin.careers.show',
                                'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-feather"></i>
                            <p>
                                Content Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission([
                                'admin.home-first-frame.index','admin.home-first-frame.create','admin.home-first-frame.show',
                                'admin.home-latest-study.index','admin.home-latest-study.create','admin.home-latest-study.show',
                                'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                                        'admin.advocacies.index','admin.advocacies.create','admin.advocacies.show',
                                'admin.news.index','admin.news.create','admin.news.show',
                                'admin.careers.index','admin.careers.create','admin.careers.show',
                                'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                'admin.events.index','admin.events.create','admin.events.show',
                                ]))
                            <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                                    'admin.home-first-frame.index','admin.home-first-frame.create','admin.home-first-frame.show',
                                    'admin.home-latest-study.index','admin.home-latest-study.create','admin.home-latest-study.show',
                                    'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                                            'admin.advocacies.index','admin.advocacies.create','admin.advocacies.show',
                                    'admin.news.index','admin.news.create','admin.news.show',
                                    'admin.careers.index','admin.careers.create','admin.careers.show',
                                    'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                    'admin.events.index','admin.events.create','admin.events.show',
                                ]) }}">
                                <a href="javascript:void(0)" class="nav-link pl-4">
                                    <i class="nav-icon fas fa-feather"></i>
                                    <p>
                                        Home Page
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if ($self->hasAnyPermission(['admin.home-first-frame.index','admin.home-first-frame.create','admin.home-first-frame.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.home-first-frame.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.home-first-frame.index','admin.home-first-frame.create','admin.home-first-frame.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Slider (First Frame)
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($self->hasAnyPermission(['admin.advocacies.index','admin.advocacies.create','admin.advocacies.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.advocacies.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.advocacies.index','admin.advocacies.create','admin.advocacies.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Advocacy
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($self->hasAnyPermission(['admin.home-latest-study.index','admin.home-latest-study.create','admin.home-latest-study.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.home-latest-study.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.home-latest-study.index','admin.home-latest-study.create','admin.home-latest-study.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Latest Study
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($self->hasAnyPermission(['admin.news.index','admin.news.create','admin.news.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.news.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.news.index','admin.news.create','admin.news.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    News
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($self->hasAnyPermission(['admin.events.index','admin.events.create','admin.events.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.events.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.events.index','admin.events.create','admin.events.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Events
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($self->hasAnyPermission(['admin.careers.index','admin.careers.create','admin.careers.update']))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.careers.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                            'admin.careers.index','admin.careers.create','admin.careers.show',
                                        ]) }} pl-5">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>
                                                Careers
                                            </p>
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @if ($self->hasAnyPermission(['admin.procurements.index','admin.procurements.create','admin.procurements.update']))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.procurements.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                            'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                                        ]) }} pl-5">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>
                                                Procurement
                                            </p>
                                        </a>
                                    </li>
                                    @endif

                                    @if ($self->hasAnyPermission(['admin.blogs.index','admin.blogs.create','admin.blogs.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Blogs
                                                </p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>

                            @endif
                            @if ($self->hasAnyPermission([
                                    'admin.challenges.index','admin.challenges.create','admin.challenges.show',
                                    'admin.solutions.index','admin.solutions.create','admin.solutions.show',
                                    'admin.frame-four.index','admin.frame-four.create','admin.frame-four.show',
                                ]))
                                <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                                        'admin.challenges.index','admin.challenges.create','admin.challenges.show',
                                        'admin.solutions.index','admin.solutions.create','admin.solutions.show',
                                        'admin.frame-four.index','admin.frame-four.create','admin.frame-four.show',
                                    ]) }}">
                                    
                                    <a href="javascript:void(0)" class="nav-link pl-4">
                                        <i class="nav-icon fas fa-feather"></i>
                                        <p>
                                            Area Of Works Page
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>

                                     <ul class="nav nav-treeview">
                                        @if ($self->hasAnyPermission(['admin.challenges.index','admin.challenges.create','admin.challenges.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.challenges.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.challenges.index','admin.challenges.create','admin.challenges.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        The Challenges
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.frame-four.index','admin.frame-four.create','admin.frame-four.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.frame-four.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.frame-four.index','admin.frame-four.create','admin.frame-four.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Workforce Devt Frame Four
                                                </p>
                                            </a>
                                        </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.solutions.index','admin.solutions.create','admin.solutions.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.solutions.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.solutions.index','admin.solutions.create','admin.solutions.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Our Solution
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                        
                                    </ul>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission(['admin.careers.index','admin.careers.create','admin.careers.show',
                                    'admin.procurements.index','admin.procurements.create','admin.procurements.show']))
                                <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                                        'admin.careers.index','admin.careers.create','admin.careers.show',
                                        'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                                    ]) }}">
                                    
                                    <a href="javascript:void(0)" class="nav-link pl-4">
                                        <i class="nav-icon fas fa-feather"></i>
                                        <p>
                                            Career Page
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>

                                     <ul class="nav nav-treeview">
                                        @if ($self->hasAnyPermission(['admin.careers.index','admin.careers.create','admin.careers.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.careers.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.careers.index','admin.careers.create','admin.careers.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Careers
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.procurements.index','admin.procurements.create','admin.procurements.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.procurements.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.procurements.index','admin.procurements.create','admin.procurements.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Procurement
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission([
                                'admin.our-leaderships.index','admin.our-leaderships.create','admin.our-leaderships.show',
                                'admin.advisers.index','admin.advisers.create','admin.advisers.show',
                                'admin.members.index','admin.members.create','admin.members.show',
                                'admin.our-people.index','admin.our-people.create','admin.our-people.show',
                            ]))
                                <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                                        'admin.our-leaderships.index','admin.our-leaderships.create','admin.our-leaderships.show',
                                        'admin.advisers.index','admin.advisers.create','admin.advisers.show',
                                        'admin.members.index','admin.members.create','admin.members.show',
                                        'admin.our-people.index','admin.our-people.create','admin.our-people.show',
                                    ]) }}">
                                    
                                    <a href="javascript:void(0)" class="nav-link pl-4">
                                        <i class="nav-icon fas fa-feather"></i>
                                        <p>
                                            Organization Page
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>

                                     <ul class="nav nav-treeview">

                                        @if ($self->hasAnyPermission(['admin.our-leaderships.index','admin.our-leaderships.create','admin.our-leaderships.update']))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.our-leaderships.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                'admin.our-leaderships.index','admin.our-leaderships.create','admin.our-leaderships.show',
                                            ]) }} pl-5">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Our Leadership
                                                </p>
                                            </a>
                                        </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.advisers.index','admin.advisers.create','admin.advisers.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.advisers.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.advisers.index','admin.advisers.create','admin.advisers.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Adviser
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.members.index','admin.members.create','admin.members.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.members.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.members.index','admin.members.create','admin.members.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Member
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.our-people.index','admin.our-people.create','admin.our-people.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.our-people.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.our-people.index','admin.our-people.create','admin.our-people.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Our People
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                       
                                    </ul>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission([
                                'admin.youthwork-first-frame.index','admin.youthwork-first-frame.create','admin.youthwork-first-frame.show',
                                'admin.youth-works-courses.index','admin.youth-works-courses.create','admin.youth-works-courses.show',
                                'admin.youth-works-teams.index','admin.youth-works-teams.create','admin.youth-works-teams.show',
                                'admin.youth-works-videos.index','admin.youth-works-videos.create','admin.youth-works-videos.show',
                                'admin.project-priority-areas.index','admin.project-priority-areas.create','admin.project-priority-areas.show',
                                'admin.growth-sectors.index','admin.growth-sectors.create','admin.growth-sectors.show',
                                'admin.faqs.index','admin.faqs.create','admin.faqs.show',
                                'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                            ])) 
                                <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                                        'admin.youthwork-first-frame.index','admin.youthwork-first-frame.create','admin.youthwork-first-frame.show',
                                        'admin.youth-works-courses.index','admin.youth-works-courses.create','admin.youth-works-courses.show',
                                        'admin.youth-works-teams.index','admin.youth-works-teams.create','admin.youth-works-teams.show',
                                        'admin.youth-works-videos.index','admin.youth-works-videos.create','admin.youth-works-videos.show',
                                        'admin.project-priority-areas.index','admin.project-priority-areas.create','admin.project-priority-areas.show',
                                        'admin.growth-sectors.index','admin.growth-sectors.create','admin.growth-sectors.show',
                                        'admin.faqs.index','admin.faqs.create','admin.faqs.show',
                                        'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                    ]) }}">
                                    
                                    <a href="javascript:void(0)" class="nav-link pl-4">
                                        <i class="nav-icon fas fa-feather"></i>
                                        <p>
                                            YouthworksPH Page
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>

                                     <ul class="nav nav-treeview">
                                        @if ($self->hasAnyPermission(['admin.youthwork-first-frame.index','admin.youthwork-first-frame.create','admin.youthwork-first-frame.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.youthwork-first-frame.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.youthwork-first-frame.index','admin.youthwork-first-frame.create','admin.youthwork-first-frame.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        First Frame
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.youth-works-courses.index','admin.youth-works-courses.create','admin.youth-works-courses.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.youth-works-courses.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.youth-works-courses.index','admin.youth-works-courses.create','admin.youth-works-courses.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                         Courses
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.youth-works-teams.index','admin.youth-works-teams.create','admin.youth-works-teams.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.youth-works-teams.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.youth-works-teams.index','admin.youth-works-teams.create','admin.youth-works-teams.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Teams
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.youth-works-videos.index','admin.youth-works-videos.create','admin.youth-works-videos.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.youth-works-videos.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.youth-works-videos.index','admin.youth-works-videos.create','admin.youth-works-videos.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Videos
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.project-priority-areas.index','admin.project-priority-areas.create','admin.project-priority-areas.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.project-priority-areas.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.project-priority-areas.index','admin.project-priority-areas.create','admin.project-priority-areas.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Project Priority Area
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.project-priority-areas.index','admin.project-priority-areas.create','admin.project-priority-areas.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.growth-sectors.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.growth-sectors.index','admin.growth-sectors.create','admin.growth-sectors.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Growth Sectors
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.faqs.index','admin.faqs.create','admin.faqs.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.faqs.index','admin.faqs.create','admin.faqs.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        FAQ
                                                    </p>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($self->hasAnyPermission(['admin.blogs.index','admin.blogs.create','admin.blogs.update']))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                                    'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                                ]) }} pl-5">
                                                    <i class="nav-icon far fa-circle"></i>
                                                    <p>
                                                        Blogs
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission(['admin.blogs.index','admin.blogs.create','admin.blogs.update']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.blogs.index','admin.blogs.create','admin.blogs.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Blogs
                                        </p>
                                    </a>
                                </li>
                            @endif
                                        
                            @if ($self->hasAnyPermission(['admin.projects.index','admin.projects.create','admin.projects.update']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.projects.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.projects.index','admin.projects.create','admin.projects.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Projects
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if ($self->hasAnyPermission(['admin.news.index','admin.news.create','admin.news.update']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.news.index','admin.news.create','admin.news.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            News
                                        </p>
                                    </a>
                                </li>
                            @endif
                           
                            @if ($self->hasAnyPermission(['admin.pages.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.pages.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.pages.index','admin.pages.create','admin.pages.show',

                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pages
                                        </p>
                                    </a>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission(['admin.page-items.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.page-items.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.page-items.index','admin.page-items.create','admin.page-items.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Page Items
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.admin-users.crud', 'admin.roles.crud', 'admin.users.crud', 'admin.activity-logs.crud']))
                    <li class="nav-item no-hover">
                        <a href="javascript:void(0)">
                            Admin Management
                        </a>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.admin-users.crud', 'admin.roles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.admin-users.index','admin.admin-users.create','admin.admin-users.show',
                            'admin.roles.index', 'admin.roles.create', 'admin.roles.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Admin Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.admin-users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.admin-users.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.admin-users.index','admin.admin-users.create','admin.admin-users.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Admins
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if ($self->hasAnyPermission(['admin.roles.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.roles.index', 'admin.roles.create', 'admin.roles.show'
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Roles & Permissions
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.activity-logs.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.activity-logs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.activity-logs.index',
                        ]) }}">
                            <i class="nav-icon fa fa-file-alt"></i>
                            <p>
                                Activity Logs
                            </p>
                        </a>
                    </li>
                @endif
                    
                @if ($self->hasAnyPermission(['admin.reports.index']))
                <li class="nav-item">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.reports.index','admin.reports.export',
                    ]) }}">
                        <i class="nav-icon fa fa-file-alt"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>

    </div>
</aside>