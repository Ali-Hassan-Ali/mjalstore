<section class="section_content_about">
    <div class="container">
        <div class="content_about">
            <div class="img_about">
                @if(!empty(getSetting('about_page_image')))
                    <img src="{{ getImageSetting('about_page_image') }}" alt="" />
                @else
                    <img src="{{ asset('site_assets/images/about-page.png') }}" alt="" />
                @endif
            </div>
            <div class="sec_head">
                <h2>{{ getTransSetting('about_page_title', app()->getLocale()) }}</h2>
                <p>{!! getTransSetting('about_page_description', app()->getLocale()) !!}</p>
            </div>
        </div>
    </div>
</section>