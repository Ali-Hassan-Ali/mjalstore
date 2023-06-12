<header id="header">
    <div class="header-top">
        <div class="container">
            <ul class="social-media topHmenu-right clearfix">
                <x-site.layout.includes.social-media/>
                <!--social-media-->
            </ul>
            <ul class="topHmenu-left clearfix">
                @if($languages)
                    <li class="dropdown">
                        <a href="product-page.html" data-toggle="dropdown">{{ trans('menu.languages') }}</a>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            @foreach($languages as $code=>$name)
                                <li><a href="{{ route('site.changeLanguage', $code) }}">{{ $name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if($currencies)
                    <li class="dropdown">
                        <a href="product-page.html" data-toggle="dropdown">{{ trans('menu.currency') }}</a>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            @foreach($currencies as $code=>$name)
                                <li><a href="{{ route('site.changeCurrency', $code) }}">{{ $name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <a href="{{ route('site.index') }}" class="logo-site">
                        <img src="{{ getImageSetting('websit_logo') }}" alt="{{ getTransSetting('websit_title', app()->getLocale()) }}" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-5 col-sm-5">
                    <form class="form-search-head" action="#">
                        <input type="text" class="form-control" placeholder="بحث عن بطاقة">
                        <button type="submit" class="btn btn-submit-search"><i class="zmdi zmdi-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="clearfix">
                        <ul class="menu-purches clearfix">
                            <li class="iconfinder"><a href="referral-system.html"><img src="{{ asset('site_assets/images/iconfinder_Referrals.svg') }}" alt="" /></a></li>
                            <li class="cart-purches-btn dropdown dropdown-cart-shooping">
                                <a class="show-cart">
                                    <div class="title-basket">
                                        <p>سلتي</p>
                                        <small>0.00$</small>
                                    </div>
                                    <figure><img src="{{ asset('site_assets/images/icon-shopping.svg') }}" /><span>3</span></figure>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="remove-drop"><i class="zmdi zmdi-close"></i></a>
                                    <li>
                                        <div class="image-product">
                                            <img src="images/prouduct.png" alt="">
                                            <a class="remove-product"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <div class="title-cart">
                                            <p><a href="#"> تذكرة العاب بلستيشن احترافي</a></p>
                                            <div class="price-counter">
                                                <strong>50$</strong>
                                                <div class="quantity-item">
                                                    <div class="quantity">
                                                        <input type="text" name="count-quat1" class="count-quat" value="1">
                                                        <div class="btn button-count inc jsQuantityIncrease"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                                        <div class="btn button-count dec jsQuantityDecrease disabled" minimum="1"><i class="fa fa-minus" aria-hidden="true"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="image-product">
                                            <img src="images/prouduct.png" alt="">
                                            <a class="remove-product"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <div class="title-cart">
                                            <p><a href="#"> تذكرة العاب بلستيشن احترافي</a></p>
                                            <div class="price-counter">
                                                <strong>50$</strong>
                                                <div class="quantity-item">
                                                    <div class="quantity">
                                                        <input type="text" name="count-quat1" class="count-quat" value="1">
                                                        <div class="btn button-count inc jsQuantityIncrease"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                                        <div class="btn button-count dec jsQuantityDecrease disabled" minimum="1"><i class="fa fa-minus" aria-hidden="true"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="total-price">
                                        <p>الاجمالي:</p>
                                        <strong>$ 130.50</strong>
                                    </div>
                                    <div class="option-cart">
                                        <a href="cart.html" class="btn-site-bg"><small>تفاصيل السلة</small></a>
                                        <a href="checkout.html" class="btn-site outline"><small>شراء الان</small></a>
                                    </div>
                                </ul>
                            </li>
                            @auth
                                <li class="login-btn pro-btn dropdown">
                                    <img src="{{ auth()->user()->image_path }}" alt="{{ auth()->user()->name }}" />
                                    <a data-toggle="dropdown">{{ auth()->user()->email }}</a>
                                    <ul class="dropdown-menu drop-profile multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <li><a href="{{ route('site.auth.profile', auth()->user()->username) }}">{{ trans('auth.profile') }}</a></li>
                                        {{-- <li><a href="cart.html">مشترياتي</a></li> --}}
                                        {{-- <li><a href="ticit-list-supports.html">تذاكر الدعم الفني</a></li> --}}
                                        <li>
                                            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                @lang('auth.logout')
                                                <form id="logout-form" action="{{ route('site.auth.logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="login-btn">
                                    <img src="{{ asset('site_assets/images/icon-user.svg') }}" alt="{{ getTransSetting('websit_title', app()->getLocale()) }}" />
                                    <a class="model-auth" data-type="login" data-toggle="modal" data-target="#exampleModal">{{ trans('auth.sign_in') }}</a>
                                    <a class="model-auth" data-type="register" data-toggle="modal" data-target="#exampleModal">{{ trans('auth.create_acount') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($categories->count())
        <div class="header-bottom">
            <div class="container">
                <div class="hb-right clearfix">
                    <a href="#menu" class="hamburger is-closed">
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </a>
                </div>
                <div class="clearfix">
                    <ul class="menu-st main-menu clearfix">
                        @foreach($categories as $category)

                            <li class="dropdown {{ 'active' }}">
                                <a href="product-page.html" data-toggle="dropdown"><img src="{{ $category->image_path }}" width="22" height="20" /><span>{{ $category->name }}</span></a>
                                @if($category->subCategoriesRelation->count())
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        @foreach($category->subCategoriesRelation as $subCategory)
                                            <li><a href="{{ route('site.sub_category', $subCategory->slug) }}">{{ $subCategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</header>