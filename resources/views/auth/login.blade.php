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
            <a href="{{ url('redirect/google') }}">Google Login</a>

        </div>
        <div class="or">
            <span>або</span>
        </div>
        <div class="registr-wrap">
            <form method="POST" action="{{ route('login') }}" class="registr-form">
                @csrf
                <div class="input-block">
                    <input id="email" type="email" placeholder="E-mail" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-block">
                    <input placeholder="{{ trans('main.password') }}" id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ trans('main.forgot_password') }}
                    </a>
                @endif
                <button class="registr-form__btn btn btn--purple">
                    {{ trans('main.login') }}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
