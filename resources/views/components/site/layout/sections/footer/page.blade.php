<section class="section_st_page">
    <div class="container">
        <div class="sec_head text-center">
            <h2>{{ $page->title }}</h2>
        </div>
        <div class="content-st_page">

            <span>{!! $page->description_one !!}</span>

            @if($page->description_tow)
                <div class="content-phar">
                    {!! $page->description_tow !!}
                </div>
            @endif

        </div>
    </div>
</section> 