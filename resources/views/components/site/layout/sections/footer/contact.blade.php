<section class="section_st_page">
    <div class="container">
        <div class="sec_head text-center">
            <h2>{{ trans('settings.contact') }}</h2>
        </div>
        <div class="content-contact">
            <div class="box-img-contact">
                <figure>
                    <img src="{{ asset('site_assets/images/contact.svg') }}" alt="{{ trans('settings.contact') }}" />
                </figure>
                <div class="follow-us">
                    <p>تابعونا على</p>
                    <x-site.layout.includes.social-media/>
                    <!--social-media-->
                </div>
            </div>
            <form class="form-contact" id="footer-contact" method="post" action="{{ route('site.contact.store') }}">
                @csrf
                @method('post')

                <div class="head-contact">
                    <span>عندك سؤال؟</span>
                    <p>تواصل معنا</p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="error-contact-name" placeholder="{{ trans('auth.name') }}" />
                    <span class="text-danger" id="error-contact-name-message"></span>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="error-contact-email" placeholder="{{ trans('auth.email') }}" />
                    <span class="text-danger" id="error-contact-email-message"></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="error-contact-subject" placeholder="الموضوع" />
                    <span class="text-danger" id="error-contact-subject-message"></span>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="body" id="error-contact-body" placeholder="نص الرسالة"></textarea>
                    <span class="text-danger" id="error-contact-body-message"></span>
                </div>
                <div class="form-group">
                    <button class="btn-site"><span>ارسال</span></button>
                </div>
            </form>
        </div>
    </div>
</section> 
<!--section_st_page-->   