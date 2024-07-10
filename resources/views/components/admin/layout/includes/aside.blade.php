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
                <span class="app-menu__label">@lang('admin.global.home')</span>
            </a>
        </li>

        @if(permissionAdmin('read-categories') || permissionAdmin('read-sub_categories'))
            {{--categories--}}
            <li class="treeview {{ request()->is('*categories*') ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user-circle"></i>
                    <span class="app-menu__label">@lang('menu.categories')</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(permissionAdmin('read-categories'))
                        <li>
                            <a class="treeview-item {{ request()->segment(2) === 'categories' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.categories')
                            </a>
                        </li>
                    @endif

                    @if(permissionAdmin('read-sub_categories'))
                        <li>
                            <a class="treeview-item {{ request()->segment(2) === 'sub_categories' ? 'active' : '' }}" href="{{ route('admin.sub_categories.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.sub_categories')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if(permissionAdmin('read-admins') || permissionAdmin('read-roles') || permissionAdmin('read-languages'))
            {{-- managements --}}
            <li class="treeview {{ request()->is('*managements*') ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user-circle"></i>
                    <span class="app-menu__label">@lang('menu.managements')</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(permissionAdmin('read-admins'))
                        <li>
                            <a class="treeview-item {{ request()->is('*admins*') ? 'active' : '' }}" href="{{ route('admin.managements.admins.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.admins')
                            </a>
                        </li>
                    @endif
                    @if(permissionAdmin('read-roles'))
                        <li>
                            <a class="treeview-item {{ request()->is('*roles*') ? 'active' : '' }}" href="{{ route('admin.managements.roles.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.roles')
                            </a>
                        </li>
                    @endif
                    @if(permissionAdmin('read-languages'))
                        <li>
                            <a class="treeview-item {{ request()->is('*languages*') ? 'active' : '' }}" href="{{ route('admin.managements.languages.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.languages')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if(permissionAdmin('read-cards') || permissionAdmin('read-markets') || permissionAdmin('read-currencies') || permissionAdmin('read-currency_prices') || permissionAdmin('read-cupons'))
            {{-- products --}}
            <li class="treeview {{ request()->is('*products*') ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user-circle"></i>
                    <span class="app-menu__label">@lang('menu.managements_products')</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(permissionAdmin('read-cards'))
                        <li>
                            <a class="treeview-item {{ request()->is('*cards*') ? 'active' : '' }}" href="{{ route('admin.products.cards.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.cards')
                            </a>
                        </li>
                    @endif

                    @if(permissionAdmin('read-markets'))
                        <li>
                            <a class="treeview-item {{ request()->is('*markets*') ? 'active' : '' }}" href="{{ route('admin.products.markets.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.markets')
                            </a>
                        </li>
                    @endif

                    @if(permissionAdmin('read-currencies'))
                        <li>
                            <a class="treeview-item {{ request()->is('*currencies*') ? 'active' : '' }}" href="{{ route('admin.products.currencies.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.currencies')
                            </a>
                        </li>
                    @endif

                    @if(permissionAdmin('read-currency_prices'))
                        <li>
                            <a class="treeview-item {{ request()->is('*currency_prices*') ? 'active' : '' }}" href="{{ route('admin.products.currency_prices.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.currency_prices')
                            </a>
                        </li>
                    @endif

                    @if(permissionAdmin('read-cupons'))
                        <li>
                            <a class="treeview-item {{ request()->is('*cupons*') ? 'active' : '' }}" href="{{ route('admin.products.cupons.index') }}">
                                <i class="icon fa fa-circle"></i>@lang('menu.cupons')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if(permissionAdmin('read-pages') || permissionAdmin('read-payment_methods') || permissionAdmin('read-contact_us'))
            {{-- footers --}}
            <li class="treeview {{ request()->is('*footers*') ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user-circle"></i>
                    <span class="app-menu__label">@lang('menu.footers')</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(permissionAdmin('read-pages'))
                    <li>
                        <a class="treeview-item {{ request()->is('*pages*') ? 'active' : '' }}" href="{{ route('admin.footers.pages.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('menu.pages')
                        </a>
                    </li>
                    @endif
                    @if(permissionAdmin('read-payment_methods'))
                    <li>
                        <a class="treeview-item {{ request()->is('*payment_methods*') ? 'active' : '' }}" href="{{ route('admin.footers.payment_methods.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('menu.payment_methods')
                        </a>
                    </li>
                    @endif
                    @if(permissionAdmin('read-contact_us'))
                    <li>
                        <a class="treeview-item {{ request()->is('*contact_us*') ? 'active' : '' }}" href="{{ route('admin.footers.contact_us.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('menu.contact_us')
                        </a>
                    </li>
                    @endif
                    
                </ul>
            </li>
        @endif

        @if(permissionAdmin('read-settings'))
            {{-- settings --}}
            <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user-circle"></i>
                    <span class="app-menu__label">@lang('menu.settings')</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item {{ request()->is('*meta*') ? 'active' : '' }}" href="{{ route('admin.settings.meta.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('settings.meta')
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item {{ request()->is('*websit*') ? 'active' : '' }}" href="{{ route('admin.settings.websit.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('settings.websit')
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item {{ request()->is('*contact*') ? 'active' : '' }}" href="{{ route('admin.settings.contact.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('settings.contact')
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item {{ request()->is('*media*') ? 'active' : '' }}" href="{{ route('admin.settings.media.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('settings.media')
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item {{ request()->is('*about_page*') ? 'active' : '' }}" href="{{ route('admin.settings.about_page.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('settings.about_page')
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item {{ request()->is('*faq*') ? 'active' : '' }}" href="{{ route('admin.settings.faq.index') }}">
                            <i class="icon fa fa-circle"></i>@lang('settings.faq')
                        </a>
                    </li>
                    
                </ul>
            </li>
        @endif

    </ul>
</aside>
