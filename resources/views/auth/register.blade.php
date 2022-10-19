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
            <div class="tabs-wrapper tab-link-wrapper">
                <a class="tab tab-active" href="#tab-1">
                    {{ trans('main.specialist') }}
                </a>
                <a class="tab" href="#tab-2">
                    {{ trans('main.company') }}
                </a>
            </div>
            <div class="tabs-wrapper tab-content-wrapper">
                <div id="tab-1" class="tabs-content tabs-content-active">
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
                        <div class="input-block custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">{{ trans('main.gender') }}</div>
                                <input required class="custom-select-input" name="gender" type="hidden" value="">
                            </div>
                            <div class="gender-list custom-select__list">
                                <div class="custom-select-item" id="male">
                                    {{ trans('main.male') }}
                                </div>
                                <div class="custom-select-item" id="female">
                                    {{ trans('main.female') }}
                                </div>
                            </div>
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
                            <input placeholder="{{ trans('main.phone') }}" name="phone" class="input" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-block">
                            <input type="date" name="birth_date" class="input" value="{{ old('birth_date') }}">
                            @error('birth_date')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label class="checkbox-block">
                            <input type="checkbox" name="type_id">
                            {{ trans('main.im_specialist') }}
                        </label>
                        <button class="registr-form__btn btn btn--purple">
                            {{ trans('main.register') }}
                        </button>
                    </form>
                </div>
                <div id="tab-2" class="tabs-content">
                    <form method="POST" action="{{ route('register') }}" class="registr-form">
                        @csrf
                        <input class="input" type="hidden" name="type_id" value="2">
                        <div class="input-block">
                            <input class="input" type="text" placeholder="Компанія">
                        </div>
                        <div class="input-block">
                            <input class="input" type="text" placeholder="E-mail">
                        </div>
                        <div class="input-block">
                            <input class="input" type="text" placeholder="Ном. тел.">
                        </div>
                        <div class="custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">Місто</div>
                                <input class="custom-select-input" type="hidden" value="Місто">
                            </div>
                            <div class="custom-select__list">
                                <div class="custom-select-item">
                                    Місто
                                </div>
                                <div class="custom-select-item">
                                    Місто2
                                </div>
                                <div class="custom-select-item">
                                    Місто3
                                </div>
                            </div>
                        </div>
                        <label class="checkbox-block">
                            <input type="checkbox">
                            Ціна обговорюється
                        </label>
                        <button class="registr-form__btn btn btn--purple">
                            Зареєструватися
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
