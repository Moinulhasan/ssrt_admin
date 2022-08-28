<div class="side-header">
    <a class="header-brand1" href="#">
        <img src="{{ asset('/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
        <img src="{{ asset('/images/brand/logo.png') }}" class="header-brand-img toggle-logo" alt="logo">
        <img src="{{ asset('/images/brand/logo.png') }}" class="header-brand-img light-logo" alt="logo">
        <img src="{{ asset('/images/brand/logo.png') }}" class="header-brand-img light-logo1" alt="logo">
    </a><!-- LOGO -->
    <a aria-label="Hide Sidebar" class="app-sidebar__toggle ms-auto" data-bs-toggle="sidebar" href="#"></a>
    <!-- sidebar-toggle-->
</div>
<div class="app-sidebar__user">
    <div class="dropdown user-pro-body text-center">
        <div class="user-pic">

            @if(auth()->user())
                @if(auth()->user()->avatar != null)
                    <img src="{{auth()->user()->avatar}}" alt="user-img"
                         class="avatar-xl rounded-circle">
                @else
                    <img src="{{asset('/theme/assets/images/users/new.png')}}" alt="user-img"
                         class="avatar-xl rounded-circle">
                @endif
            @else
                <img src="{{asset('/theme/assets/images/users/new.png')}}" alt="user-img"
                     class="avatar-xl rounded-circle">
            @endif

        </div>
        <div class="user-info">
            <h5 class="text-dark mb-0">{{auth()->user()->name}}</h5>
            <span class="text-muted app-sidebar__user-name text-sm">{{auth()->user()->name}}</span>
        </div>
    </div>
</div>
