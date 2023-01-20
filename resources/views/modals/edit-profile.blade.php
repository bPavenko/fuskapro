<div class="modal-wrap modal-balance edit-profile-modal ">
    <div class="modal modal-balance-size">
        <div class="modal__body">
            <div class="modal__close"></div>
            <div class="modal-balance__title">
                {{ trans('main.update-profile') }}
            </div>
            <form method="POST" action="{{ route('edit-user') }}"  enctype="multipart/form-data">
                <div class="modal-edit__wrapper">
                    @csrf
                    <div class="person-block">
                        <div class="person-block__img modal-edit__img person-block__img">
                            <img loading="lazy" src="{{ Auth::user()->avatar_path }}" alt="img">
                        </div>
                        <div class="person-block__info">
                            <div class="modal-edit-form__top">
                                <div class="input-file btn btn--purple">
                                    <input name="image" type="file">
                                    {{ trans('main.upload_photo') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="change-password">
                        <div class="modal-edit-profile-size">

                            <div class="input-block">
                                <div class="form-block-title">{{ trans('main.name') }}</div>
                                <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" placeholder="{{ trans('main.name') }}" required autocomplete="name" autofocus>

                                @if($errors->first('name'))
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-block">
                                <div class="form-block-title">{{ trans('main.surname') }}</div>

                                <input class="input" required name="surname" type="text" value="{{ Auth::user()->surname }}" placeholder="{{ trans('main.surname') }}">
                                @if($errors->first('surname'))
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-block">
                                <div class="form-block-title">{{ trans('main.email') }}</div>

                                <input id="email" type="email" value="{{ Auth::user()->email }}" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @if($errors->first('email'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-block">
                                <div class="form-block-title">{{ trans('main.city') }}</div>

                                <input required type="hidden" name="city" id="city-id" value="{{ Auth::user()->city }}">
                                <input placeholder="{{ trans('main.city') }}" id="profile-city-search" name="city_name" value="{{ Auth::user()->cityName }}" class="input" type="text">
                                <div class="ui-front"></div>
                                @if($errors->first('city'))
                                    <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                                @endif
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
                            <div class="input-block">
                                <div class="form-block-title">{{ trans('main.phone') }}</div>

                                <input placeholder="{{ trans('main.phone') }}" name="phone" class="input" value="{{ Auth::user()->phone }}">
                                @if($errors->first('phone'))
                                    <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="input-block custom-select">
                                <div class="custom-select__top">
                                    <div class="custom-select-value">@if(Auth::user()->type_id == 1) {{ trans('main.user') }} @else {{ trans('main.specialist') }} @endif</div>
                                    <input class="custom-select-input" name="type_id" type="hidden" value="{{ Auth::user()->type_id  }}">
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
                            <div class="textarea-block">
                                <div class="form-block-title">{{ trans('main.about_me') }}</div>
                                <textarea name="about_me" value="{{ Auth::user()->about_me }}" placeholder="Опис" class="textarea"></textarea>
                            </div>

                        </div>
                        <button class="edit-form__btn btn btn--purple">
                            {{ trans('main.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{--{{ dd($errors->has('birth_date'), $errors->birth_date, $errors->first('birth_date')) }}--}}
{{--{{ dd($errors) }}--}}
<script type="text/javascript">
    @if (isset(session('active_modals')['edit-profile']))
        $('.edit-profile-modal').addClass('active');
    @endif
</script>
