@if(!empty($faqs))
    <section class="section_page_site" style="background: url('{{ assert('site_assets/images/img-faq.svg') }}');">
        <div class="container">
            <div class="sec_head text-center">
                <h2>{{ trans('settings.faq') }}</h2>
            </div>
            <div class="content-page">
                <ul class="list-faq">
                    @foreach($faqs as $faq)
                        <li>
                            <div class="accordion">
                                <p class="faqText">{{ getMulteSetting('faq', 'title', $loop->index, app()->getLocale()) }}</p>
                                <i class="fa fa-{{ $loop->first ? 'minus' : 'plus' }}"></i>
                            </div>
                            <div class="panel default" style="display: {{ $loop->first ? 'block' : 'none' }};">
                                <p>{!! getMulteSetting('faq', 'description', $loop->index, app()->getLocale()) !!}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section> 
@endif