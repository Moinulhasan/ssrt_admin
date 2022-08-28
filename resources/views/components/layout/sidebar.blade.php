<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                    <span>
                        <button type="button"
                                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                @if(count(session()->get('all_nav')) > 0)
                    @foreach(session()->get('all_nav') as $nav)
                        @if(array_key_exists($nav->id,$access['module']))
                            @if(count($nav->sub) > 0)
                                <li {{ request()->is($nav->route.'*') ? 'class=mm-active' : '' }}>
                                    <a href="#">
                                        <i class="metismenu-icon {{$nav->icon}}"></i>{{$nav->name}}
                                        <i class="metismenu-state-icon pe-7s-angle-down  caret-left"></i>
                                    </a>
                                    <ul>

                                        @foreach($nav->sub as $sub)
                                            @if(array_key_exists($sub->id,$access['module'][$nav->id]))
                                                {{--                                                {{var_dump(str_contains($sub->route,'add'))}}--}}
                                                {{--                                                {{add($access['module'][$nav->id][$sub->id])}}--}}
                                                @if(str_contains($sub->route,'add'))
                                                    @if(in_array('add',$access['module'][$nav->id][$sub->id]))
                                                        <li>
                                                            <a href="{{route($sub->route)}}" {{url()->current()==route($sub->route) ? 'class=mm-active' : ''}}>
                                                                <i class="metismenu-icon"></i>{{$sub->name}}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li>
                                                        <a href="{{route($sub->route)}}" {{url()->current()==route($sub->route) ? 'class=mm-active' : ''}}>
                                                            <i class="metismenu-icon"></i>{{$sub->name}}
                                                        </a>
                                                    </li>
                                                @endif

                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif
                {{--                for developer section--}}

                @if($valid)
                    <li {{ request()->is('nav*') ? 'class=mm-active' : '' }}>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-link"></i>NavItem
                            <i class="metismenu-state-icon pe-7s-angle-down  caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{asset(route('nav.index'))}}" {{url()->current()==route('nav.index') ? 'class=mm-active' : ''}}><i
                                        class="metismenu-icon"></i>NavItem List</a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
