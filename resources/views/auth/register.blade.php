@extends('layouts.app')

@section('content')
<div class="container entry-wrap-container">
    <div class="entry-wrap">
        <div class="entry-soc">
            <a href="#" class="entry-soc__img">
                <img src="img/entry-soc-img.png" alt="img">
            </a>
            <a href="#" class="entry-soc__img">
                <img src="img/entry-soc-img2.png" alt="img">
            </a>
        </div>
        <div class="registr-wrap">
                    <form method="POST" action="{{ route('register') }}" class="registr-form">
                        @csrf
                        <div class="input-block">
                            <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ trans('main.name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <input class="input" required name="surname" type="text" value="{{ old('surname') }}" placeholder="{{ trans('main.surname') }}">
                            @error('surname')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <input id="email" type="email" placeholder="E-mail" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <input placeholder="{{ trans('main.password') }}" id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <input placeholder="{{ trans('main.repeat_password') }}" id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="input-block">
                            <input required type="hidden" name="city" id="city-id" value="{{ old('city') }}">
                            <input placeholder="{{ trans('main.city') }}" id="city-search" name="city_name" value="{{ old('city_name') }}" class="input" type="text">
                            @error('city')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <input required placeholder="{{ trans('main.phone') }}" name="phone" class="input" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-block custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">{{ trans('main.citizenship') }}</div>
                                <input class="custom-select-input" name="country_code" type="hidden" value="">
                            </div>
                            <div class="profession-list custom-select__list countries-list">
                                @foreach(\App\Models\User::countriesList() as $key => $country)
                                    <div class="custom-select-item" id="{{ $key }}">
                                        <img src="{{ asset('vendor/blade-country-flags/4x3-'. $key . '.svg') }}" width="15"/>
                                        {{ $country }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="input-block custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">{{ trans('main.user') }}</div>
                                <input class="custom-select-input" name="type_id" type="hidden" value="1">
                            </div>
                            <div class="profession-list custom-select__list">
                                <div class="custom-select-item" id="1">
                                    {{ trans('main.user') }}
                                </div>
                                <div class="custom-select-item" id="2">
                                    {{ trans('main.specialist') }}
                                </div>
                            </div>
                        </div>

                        <button class="registr-form__btn btn btn--purple">
                            {{ trans('main.register') }}
                        </button>
                    </form>
{{--                <div id="tab-2" class="tabs-content">--}}
{{--                    <form method="POST" action="{{ route('register') }}" class="registr-form">--}}
{{--                        @csrf--}}
{{--                        <input class="input" type="hidden" name="type_id" value="2">--}}
{{--                        <div class="input-block">--}}
{{--                            <input class="input" type="text" placeholder="Компанія">--}}
{{--                        </div>--}}
{{--                        <div class="input-block">--}}
{{--                            <input class="input" type="text" placeholder="E-mail">--}}
{{--                        </div>--}}
{{--                        <div class="input-block">--}}
{{--                            <input class="input" type="text" placeholder="Ном. тел.">--}}
{{--                        </div>--}}
{{--                        <div class="custom-select">--}}
{{--                            <div class="custom-select__top">--}}
{{--                                <div class="custom-select-value">Місто</div>--}}
{{--                                <input class="custom-select-input" type="hidden" value="Місто">--}}
{{--                            </div>--}}
{{--                            <div class="custom-select__list">--}}
{{--                                <div class="custom-select-item">--}}
{{--                                    Місто--}}
{{--                                </div>--}}
{{--                                <div class="custom-select-item">--}}
{{--                                    Місто2--}}
{{--                                </div>--}}
{{--                                <div class="custom-select-item">--}}
{{--                                    Місто3--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <label class="checkbox-block">--}}
{{--                            <input type="checkbox">--}}
{{--                            Ціна обговорюється--}}
{{--                        </label>--}}
{{--                        <button class="registr-form__btn btn btn--purple">--}}
{{--                            Зареєструватися--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
@endsection
