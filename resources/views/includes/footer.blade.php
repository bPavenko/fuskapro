<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <div class="footer__left">
                <div class="footer__logo">
                    <img loading="lazy" src="img/logo-white.svg" alt="img">
                </div>
                <div class="soc-block">
                    <a href="#">
                        <img loading="lazy" src="img/youtube-mini.svg" alt="img">
                    </a>
                    <a href="#">
                        <img loading="lazy" src="img/linkedin.svg" alt="img">
                    </a>
                    <a href="#">
                        <img loading="lazy" src="img/facebook.svg" alt="img">
                    </a>
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
{{--                <div class="footer-list">--}}
{{--                    <div class="footer-list__title">Title</div>--}}
{{--                    <a href="#">Link</a>--}}
{{--                    <a href="#">Link</a>--}}
{{--                    <a href="#">Link</a>--}}
{{--                    <a href="#">Link</a>--}}
{{--                    <a href="#">Link</a>--}}
{{--                </div>--}}
{{--                <div class="footer-list">--}}
{{--                    <div class="footer-list__title">APP</div>--}}
{{--                    <a href="#">Apple Store</a>--}}
{{--                    <a href="#">Play Market</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            Copyright © 2022 Work Company. All rights reserved.
        </div>
    </div>
</footer>