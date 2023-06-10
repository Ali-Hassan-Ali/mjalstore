<section class="section_download_app">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1366" height="518.657" viewBox="0 0 1366 518.657">
      <defs>
        <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
          <stop offset="0" stop-color="#199afe"/>
          <stop offset="1" stop-color="#8f06fa"/>
        </linearGradient>
      </defs>
      <path id="Path_778" data-name="Path 778" d="M0,9.855S341.87-55.777,683.37-55.777,1366,9.855,1366,9.855V462.88S1024.87,398.9,683.37,398.9,0,462.88,0,462.88Z" transform="translate(0 55.777)" fill="url(#linear-gradient)"/>
    </svg>
    <div class="container">
        <div class="content-download">
            <div class="img-download">
                <img src="{{ asset('site_assets/images/img-dwonload-app.svg') }}" alt="" />
            </div>
            <div class="title-download">
                <h2>حمل تطبيق مجال ستور</h2>
                <p>تسطيع تحميل تطبيق ماي هوم على كلا النظامين للأندرويد والايفون وشراء المنتجات والبطاقات بشكل سريع ومن جوالك مباشرة</p>
                <span>حمل التطبيق الآن وتمتع بخدماتنا</span>
                <ul>
                    <li>
                        <a href="{{ getSetting('media_google_play') }}" target="_blank">
                            <img src="{{ asset('site_assets/images/google-play.svg') }}" />
                        </a>
                    </li>
                    <li>
                        <a href="{{ getSetting('media_apple_store') }}" target="_blank">
                            <img src="{{ asset('site_assets/images/app-store.svg') }}" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>