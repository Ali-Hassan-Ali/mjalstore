<div class="mobile-menu">
    <div class="menu-mobile">
        <div class="brand-area">
            <a href="{{ route('site.index') }}">
                <img src="{{ getImageSetting('websit_logo') }}" alt="{{ getTransSetting('websit_title', app()->getLocale()) }}">
            </a>
        </div>
        <div class="mmenu">
            <ul>
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                    <li class="{{ $category->subCategoriesRelation->count() ? 'dropdown' : '' }} {{ 'active' }}">
                        <a href="#" {{ $category->subCategoriesRelation->count() ? 'data-toggle=dropdown' : '' }}>
                            <img src="{{ $category->image_path }}" /><span>{{ $category->name }}</span>
                        </a>
                        @if($category->subCategoriesRelation)
                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                @foreach($category->subCategoriesRelation as $subCategory)
                                    <li><a href="{{ route('site.sub_category', $subCategory->slug) }}">{{ $subCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @endforeach
                @endif
                <li class="login-btn">
                    <img src="{{ asset('site_assets/images/icon-user.svg') }}" alt="{{ getTransSetting('websit_title', app()->getLocale()) }}"/>
                    <a data-toggle="modal" data-target="#exampleModal">تسجيل الدخول</a>
                    <a data-toggle="modal" data-target="#exampleModal">انشاء حساب</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-overlay"></div>
</div>