<header class="header">
    @php
        if (!Session::get('locale')) {
            Session::put('locale', 'ua');
        }
        $locales = ['ua', 'en', 'cz'];
    @endphp
    <div class="container">
        <a href="{{ url('/') }}" class="logo">
            <img style="width: 100%; height:100% " loading="lazy" src="{{URL::asset('/img/Fuska_pro_color.png')}}" alt="img">
        </a>
        @if (Route::has('login'))
            <div class="header-btns" data-da=".mob-menu, 580, 0">
                @auth
                    <a href="{{ url('/my-orders') }}" class="basket hed-circle" data-da=".header-person-mob, 580, 0"></a>
                    <a href="{{ url('/notifications') }}" class="notifications dot-show hed-circle"></a>
                    <a href="#" class="coins hed-circle " data-da=".header-person-mob, 1023, 1">{{ trans('main.coins') }}: 0</a>
                    <div class="hed-person-menu">
                        <div class="hed-person">
                            <div class="hed-person__icon">
                                <img loading="lazy" src="{{ Auth::user()->avatar_path }}" alt="img">
                            </div>
                            <div class="hed-person__name">
                                {{Auth::user()->name}} <br>
                                {{Auth::user()->surname}}
                            </div>
                        </div>
                        <div class="hed-person-menu-list">
                            <a href="{{ route('home') }}" class="lang__link">{{ trans('main.profile') }}</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('account-logout-form').submit();" class="lang__link">{{ trans('auth.logout') }}</a>
                        </div>
                        <form id="account-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            @csrf
                        </form>
                    </div>

{{--                    <a href="{{ route('logout') }}"--}}
{{--                       class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4" onclick="event.preventDefault(); document.getElementById('account-logout-form').submit();">--}}
{{--                                        <span class="icon icon-sm icon-secondary">--}}
{{--                                            <i class="fas fa-sign-out-alt"></i>--}}
{{--                                        </span>--}}
{{--                        <div class="ml-4">--}}
{{--                                            <span class="text-dark d-block">--}}
{{--                                                Logout--}}
{{--                                            </span>--}}
{{--                            <span class="small">Logout from your account!</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}

                @else
                    <a href="{{ route('login') }}" class="header__btn">
                        {{ trans('auth.login') }}
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="header__btn btn btn--purple">
                            {{ trans('auth.register') }}
                        </a>
                    @endif

                @endauth
            </div>
        @endif

{{--        <div class="header-person">--}}
{{--            <a href="#" class="basket hed-circle" data-da=".header-person-mob, 1023, 0"></a>--}}
{{--            <a href="#" class="notifications dot-show hed-circle"></a>--}}
{{--            <a href="#" class="coins hed-circle " data-da=".header-person-mob, 1023, 1">{{ trans('main.coins') }}: 0</a>--}}
{{--            <a href="#" class="hed-person-menu">--}}
{{--                <div class="hed-person">--}}
{{--                    <div class="hed-person__icon">--}}
{{--                        <img loading="lazy" src="{{URL::asset('/img/hed-person-icon.png')}}" alt="img">--}}
{{--                    </div>--}}
{{--                    <div class="hed-person__name">--}}
{{--                        John <br>--}}
{{--                        Doe--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="hed-person-menu-list">--}}
{{--                    <a href="{{ route('locale', ['locale' => 'UA']) }}" class="lang__link">{{ strtoupper('test') }}</a>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="lang" data-da=".mob-menu, 580, 2">
            <div class="lang-act">
                <a href="{{ route('locale', ['locale' => Session::get('locale') ? Session::get('locale') : 'EN']) }}" class="lang__link">{{ strtoupper(Session::get('locale')) }}</a>
            </div>
            <div class="lang__list">
                @foreach($locales as $locale)
                    @if ($locale != Session::get('locale'))
                        <a href="{{ route('locale', ['locale' => $locale]) }}" class="lang__link">{{ strtoupper($locale) }}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="mob-menu">
            <div class="header-person-mob"></div>
        </div>
    </div>
</header>
