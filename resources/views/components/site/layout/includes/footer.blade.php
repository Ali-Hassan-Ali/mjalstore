<footer id="footer">
    <div class="top-ft">
        <div class="container">
            <ul class="menu-ft">
                @if(count($pages))
                    @foreach($pages as $slug=>$name)
                        <li>
                            <a href="{{ route('site.page.index', $slug) }}">{{ $name }}</a>
                        </li>
                    @endforeach
                @endif
                <li><a href="{{ route('site.faq.index') }}">{{ trans('settings.faq') }}</a></li>
                <li><a href="{{ route('site.about.index') }}">{{ trans('settings.about_page') }}</a></li>
                <li><a href="{{ route('site.contact.index') }}">{{ trans('settings.contact') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="middle-ft">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="log-soci">
                        <div class="logo-ft">
                            <figure><img src="{{ getImageSetting('websit_logo') }}" alt="{{ getTransSetting('websit_title', app()->getLocale()) }}" /></figure>
                            <p>{{ getTransSetting('websit_description', app()->getLocale()) }}</p>
                        </div>
                        <ul class="social-media">
                            <x-site.layout.includes.social-media/>
                            <!--social-media-->
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="list-contact">
                        @if(!empty(getSetting('contact_phone')))
                            <li>
                                <img src="{{ asset('site_assets/images/phone-call.svg') }}"/>
                                <p>
                                    <a href="tel:{{ getSetting('contact_phone') }}" class="text-dark">
                                        {{ getSetting('contact_phone') }}
                                    </a>
                                </p>
                            </li>
                        @endif
                        @if(!empty(getSetting('contact_email')))
                            <li>    
                                <img src="{{ asset('site_assets/images/email.svg') }}"/>
                                <p class="text-dark">
                                    <a href="mailto:{{ getSetting('contact_email') }}" class="text-dark"> 
                                        {{ getSetting('contact_email') }}
                                    </a>
                                </p>
                            </li>
                        @endif
                        @if(!empty(getSetting('contact_address_link')))
                            <li>
                                <img src="{{ asset('site_assets/images/pin.svg') }}"/>
                                <p>
                                    <a href="{{ getSetting('contact_address_link') }}" target="_blank" class="text-dark">
                                        {{ getSetting('contact_address') }}
                                    </a>
                                </p>
                            </li>
                        @endif
                    </ul>
                </div>
                @if(!empty($paymentMethods))
                    <div class="col-md-5">
                        <div class="payment">
                            <p>{{ trans('menu.payment_methods') }}</p>
                            <ul>
                                @foreach($paymentMethods as $image)
                                    <li><img src="{{ asset('storage/' . $image) }}" width="40" /></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="bottom-ft">
        <div class="container">
            <div class="copyright">
                <p>Copyright © {{ now()->month }} , MJAL STORE</p>
            </div>
        </div>
    </div>
</footer>