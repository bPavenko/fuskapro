<div class="modal-wrap modal-balance edit-profile-modal">
    <div class="modal modal-balance-size">
        <div class="modal__body">
            <div class="modal__close"></div>
            <div class="modal-balance__title">
                Редагувати профіль
            </div>
                <form method="POST" action="{{ route('edit-user') }}" class="change-password">
                    @csrf
                    <div class="modal-edit-profile-size">
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.name') }}</div>
                            <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" placeholder="{{ trans('main.name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.surname') }}</div>

                            <input class="input" required name="surname" type="text" value="{{ Auth::user()->surname }}" placeholder="{{ trans('main.surname') }}">
                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.email') }}</div>

                            <input id="email" type="email" value="{{ Auth::user()->email }}" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-block-title">{{ trans('main.gender') }}</div>
                        <div class="input-block custom-select">

                            <div class="custom-select__top">
                                <div class="custom-select-value">{{ trans('main.gender') }}</div>
                                <input required class="custom-select-input" name="gender" type="hidden" value="{{ trans('main.' . Auth::user()->gender) }}">
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
                            <div class="form-block-title">{{ trans('main.city') }}</div>

                            <input required type="hidden" name="city" id="city-id" value="{{ Auth::user()->city }}">
                            <input placeholder="{{ trans('main.city') }}" id="profile-city-search" name="city_name" value="{{ Auth::user()->cityName }}" class="input" type="text">
                            <div class="ui-front"></div>
                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.phone') }}</div>

                            <input placeholder="{{ trans('main.phone') }}" name="phone" class="input" value="{{ Auth::user()->phone }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.birth_date') }}</div>

                            <input type="date" name="birth_date" class="input" value="{{ Auth::user()->birth_date  }}">
                            @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="textarea-block">
                            <div class="form-block-title">{{ trans('main.about_me') }}</div>
                            <textarea name="about_me" value="{{ Auth::user()->about_me }}" placeholder="Опис" class="textarea"></textarea>
                        </div>
                    </div>
                    <button class="edit-form__btn btn btn--purple">
                        {{ trans('main.register') }}
                    </button>
                </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    @if (count($errors) > 0)
        $('.edit-profile-modal').addClass('active');
    @endif
</script>
