<footer id="footer">
    <div class="top-ft">
        <div class="container">
            <ul class="menu-ft">
                <li><a href="policy.html">سياسة الاستخدام</a></li>
                <li><a href="privacy.html">سياسة الخصوصية</a></li>
                <li><a href="recovery.html">سياسة الاسترجاع</a></li>
                <li><a href="faq.html">الأسئلة الشائعة</a></li>
                <li><a href="about.html">من نحن</a></li>
                <li><a href="contact.html">تواصل معنا</a></li>
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
                <div class="col-md-5">
                    <div class="payment">
                        <p>وسائل الدفع</p>
                        <ul>
                            <li><img src="images/master_card.png" /></li>
                            <li><img src="images/paypal.png" /></li>
                            <li><img src="images/visa.png" /></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-ft">
        <div class="container">
            <div class="copyright">
                <p>Copyright © 2020 , MJAL STORE</p>
            </div>
        </div>
    </div>
</footer>