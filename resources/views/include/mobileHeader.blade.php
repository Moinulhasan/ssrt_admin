<!-- Mobile Header -->
<div class="mobile-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>
            <!-- sidebar-toggle-->
            <a class="header-brand" href="index.html">
                <img src="{{asset('/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{asset('/images/brand/logo.png')}}"
                     class="header-brand-img desktop-logo mobile-light" alt="logo">
            </a>
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <div class="dropdown profile-1">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
										<span>
                                             @if(auth()->user()->avatar != null)
                                                <img src="{{auth()->user()->avatar}}"
                                                     alt="profile-user"
                                                     class="avatar  profile-user brround cover-image">
                                            @else
                                                <img src="{{asset('/theme/assets/images/users/new.png')}}"
                                                     alt="profile-user"
                                                     class="avatar  profile-user brround cover-image">
                                            @endif
										</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0">{{auth()->user()->name}}</h5>
                                <small class="text-muted">{{auth()->user()->name}}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon  mdi mdi-settings"></i> Settings
                        </a>
                        <form action="{{asset(route('logout'))}}" method="get">
                            @csrf
                            @method('get')
                            <button type="submit" class="dropdown-item">
                                <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
