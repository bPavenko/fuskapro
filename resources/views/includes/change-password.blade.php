<form method="POST" action="{{ route('change-password') }}" class="change-password">
    @csrf

    <div class="input-block">
        <input class="input" required name="old_password" placeholder="{{ trans('main.old_password') }}" type="password">
    </div>
    <div class="input-block">
        <input required placeholder="{{ trans('main.password') }}" id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

        @if($errors->first('password'))
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-block">
        <input required placeholder="{{ trans('main.repeat_password') }}" id="password-confirm" type="password" class="input" name="password_confirmation" autocomplete="new-password">
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <button type="submit" class="change-password__btn btn btn--orange trigger-pasword-done1">
        {{ trans('main.save_password') }}
    </button>
</form>