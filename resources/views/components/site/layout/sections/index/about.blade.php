<section class="section_about">
    <div class="flex-about">
        <div class="img-about">
            <img src="{{ asset('site_assets/images/bg-about.svg') }}" alt="" />
        </div>
        <div class="title-about">
            <div class="head-about">
                <p>عن الموقع</p>
            </div>
            <div class="video-about">
                <a data-fancybox="images" href="{{ getSetting('media_video_links') }}">
                    <div class="play-btn"><i class="fa fa-play"></i></div> 
                    <img class="img-fluid video-pic" src="{{ asset('site_assets/images/about.png') }}" alt="">
                 </a>
            </div>
            <div class="shape-about"></div>
        </div>
    </div>
</section>