<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar" style="::-webkit-scrollbar-track {box-shadow: inset 0 0 5px grey;border-radius: 10px;}">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <h2 class="app-sidebar__user-name">{{ auth('admin')->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->roles->first()->name }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li>
            <a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">@lang('site.home')</span>
            </a>
        </li>

        {{--categories--}}
        <li class="treeview {{ request()->is('*categories*') ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-user-circle"></i>
                <span class="app-menu__label">@lang('site.categories')</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ request()->segment(2) === 'categories' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="icon fa fa-circle"></i>@lang('site.categories')
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ request()->segment(2) === 'sub_categories' ? 'active' : '' }}" href="{{ route('admin.sub_categories.index') }}">
                        <i class="icon fa fa-circle-o"></i>@lang('site.sub_categories')
                    </a>
                </li>
            </ul>
        </li>

        {{-- managements --}}
        <li class="treeview {{ request()->is('*managements*') ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-user-circle"></i>
                <span class="app-menu__label">@lang('site.managements')</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ request()->is('*admins*') ? 'active' : '' }}" href="{{ route('admin.managements.admins.index') }}">
                        <i class="icon fa fa-circle-o"></i>@lang('site.admins')
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ request()->is('*roles*') ? 'active' : '' }}" href="{{ route('admin.managements.roles.index') }}">
                        <i class="icon fa fa-circle-o"></i>@lang('site.roles')
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ request()->is('*languages*') ? 'active' : '' }}" href="{{ route('admin.managements.languages.index') }}">
                        <i class="icon fa fa-circle-o"></i>@lang('site.languages')
                    </a>
                </li>
            </ul>
        </li>
        {{-- settings --}}
        <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-user-circle"></i>
                <span class="app-menu__label">@lang('site.managements')</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ request()->is('*meta*') ? 'active' : '' }}" href="{{ route('admin.settings.meta.index') }}">
                        <i class="icon fa fa-circle-o"></i>@lang('settings.meta')
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
