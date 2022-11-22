<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <div class="footer__left">
                <div class="logo">
                    <img loading="lazy"  src="{{URL::asset('/img/fuska_pro_white_color.png')}}" alt="img">
                </div>
            </div>
            <div class="footer__right">
                @php
                 $footerTitles = \App\Models\FooterTitle::all();
                @endphp
                @foreach($footerTitles as $title)
                    <div class="footer-list">
                        <div class="footer-list__title">{{ $title->name }}</div>
                        @foreach($title->links as $link)
                        <a href="{{ $link->link }}">{{ $link->name }}</a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            Copyright © 2022 Work Company. All rights reserved.
        </div>
    </div>
</footer>