@if(!empty(getSetting('media_facebook')))
    <li>
        <a href="{{ getSetting('media_facebook') }}" target="_blank">
            <i class="fa fa-facebook"></i>
        </a>
    </li>
@endif

@if(!empty(getSetting('media_twitter')))
    <li>
        <a href="{{ getSetting('media_twitter') }}" target="_blank">
            <i class="fa fa-twitter"></i>
        </a>
    </li>
@endif

@if(!empty(getSetting('media_instagram')))
    <li>
        <a href="{{ getSetting('media_instagram') }}" target="_blank">
            <i class="fa fa-instagram"></i>
        </a>
    </li>
@endif
<li><a href=""><i class="fa fa-rss"></i></a></li>