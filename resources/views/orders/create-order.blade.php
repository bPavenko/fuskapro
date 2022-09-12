@extends('layouts.app')
@section('content')
    <div class="top-ban">
        <img class="top-ban__bg" src="img/top-ban-bg.jpg" alt="img">
        <div class="container">
            <h1 class="top-ban__title">{{ trans('main.create_order_title') }}</h1>
        </div>
    </div>
    <div class="creation-form">
        <div class="container">
            <form method="POST" action="{{ route('store-order') }}" class="creation-form-left">
                @csrf
                <div class="select-block">
                    <div class="form-block-title">{{ trans('main.section') }}:</div>
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div class="custom-select-value">{{ trans('main.choose_section') }}</div>
                            <input name="section_id" class="custom-select-input" type="hidden" value="Оберіть розділ" placeholder="Выберите категорию">
                        </div>
                        <div class="sections-list custom-select__list">
                            @foreach($sections as $section)
                                <div id="{{ $section->id }}" class="custom-select-item">
                                    {{$section->name}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="select-block">
                    <div class="form-block-title">{{ trans('main.category') }}:</div>
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div class="custom-select-value">{{ trans('main.choose_category') }}</div>
                            <input name="category_id" class="custom-select-input" type="hidden" placeholder="Оберіть категорію">
                        </div>
                        <div class="categories-list custom-select__list">
                        </div>
                    </div>
                </div>
                <div class="select-block">
                    <div class="form-block-title">{{ trans('main.city') }}:</div>
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div class="custom-select-value">Місто</div>
                            <input required class="custom-select-input" name="city" type="hidden" value="">
                        </div>
                        <div class="cities-list custom-select__list">
                            <div class="custom-select-item">
                                Київ
                            </div>
                            <div class="custom-select-item">
                                Львів
                            </div>
                            <div class="custom-select-item">
                                Одесса
                            </div>
                        </div>
                    </div>
                </div>
                <div hidden>
                    {{ trans('main.open') }}
                    {{ trans('main.progress') }}
                </div>
                <div class="creation-form-detail">
                    <div class="creation-form-detail__title">
                        {{ trans('main.more_about_order') }}:
                    </div>
                    <div class="input-block">
                        <div class="form-block-title">
                            <span>{{trans('main.title')}}</span>
                        </div>
                        <input required name="title" class="input" type="text">
                    </div>
                    <div class="input-block">
                        <div class="form-block-title">
                            {{ trans('main.what_need_to_do') }} <span>({{trans('main.short')}})</span>
                        </div>
                        <input required name="short_description" class="input" type="text">
                    </div>
                    <div class="textarea-block">
                        <div class="form-block-title">
                            {{ trans('main.describe_more_about_order') }}:
                        </div>
                        <textarea required name="full_description" class="textarea"></textarea>
                        <div class="textarea-block__bottom">
                            <button class="textarea__btn">
                                {{ trans('main.leave_contacts') }} <span>({{ trans('main.confidentially') }})</span>
                            </button>
                            <div class="input-file">
                                <input type="file">
                                {{ trans('main.add_file') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="creation-form-date">
                    <div class="creation-form-title">
                        {{ trans('main.execute_to') }}:
                    </div>
                    <div class="creation-form-date__wrapper">
                        <div class="swiper creation-form-swiper">
                            <div class="swiper-wrapper">
                                @foreach($dates as $key => $date)
                                    <div class="swiper-slide">
                                        <div class="creation-form-date-item">
                                            <input value="{{$date['format_date']}}" type="radio" name="execution_date">
                                            <div class="creation-form-date-item__top">
                                                {{$date['month']}}
                                            </div>
                                            <div class="creation-form-date-item__num">
                                                {{$date['day']}}
                                            </div>
                                            @if($key == 0)
                                            <div class="creation-form-date-item__today">
                                                {{ trans('main.today') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div class="creation-form-time">
                    <div class="creation-form-title">
                        {{ trans('main.execute_to_time') }}
                    </div>
                    <div class="creation-form-time__wrapper">
                        <label class="radio-block">
                            <input type="radio" name="time">
                            {{ trans('main.anytime') }}
                        </label>
                        <div class="radio-block radio-block-selects">
                            <input type="radio" name="without_execution_time" checked>
                            <div class="custom-select">
                                <div class="custom-select__top">
                                    <div class="custom-select-value">00:00</div>
                                    <input class="custom-select-input" name="start_execution_time" type="hidden" value="00:00">
                                </div>
                                <div class="time-select custom-select__list">
                                    @foreach($times as $time)
                                        <div class="custom-select-item">
                                            {{$time}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p>до</p>
                            <div class="custom-select">
                                <div class="custom-select__top">
                                    <div class="custom-select-value">00:00</div>
                                    <input class="custom-select-input" name="end_execution_time"  type="hidden" value="00:00">
                                </div>
                                <div class="time-select custom-select__list">
                                    @foreach($times as $time)
                                        <div class="custom-select-item">
                                            {{$time}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="creation-form-suma">
                    <div class="creation-form-title">
                        {{ trans('main.estimated_cost_work') }}:
                    </div>
                    <div class="creation-form-suma__top">
                        <p>{{ trans('main.publication_price_text') }} <span>10 {{ trans('main.coins') }}</span></p>
                        <label class="checkbox-block">
                            <input required name="is_confirm" type="checkbox" checked>
                            {{ trans('main.agree') }}
                        </label>
                    </div>
                    <div class="creation-form-suma__bottom">
                        <div class="input-block">
                            <input name="price" class="input" type="text">
                            €
                        </div>
                        <label class="checkbox-block">
                            <input name="price_negotiable" type="checkbox">
                            {{ trans('main.price_negotiable') }}
                        </label>
                        <button class="creation-form__btn btn btn--orange">
                            {{ trans('main.publish') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="creation-form-right">
                <div class="creation-form-right__title">
                    {{ trans('main.top_specialists') }}
                </div>
                <div class="creation-form-right__subtitle">
                    Розробка логотипу
                </div>
                <div class="creation-form-right__wrapper">
                    <div class="person-row row-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="img/person-block-img4.png" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    Perry Jackson
                                </div>
                                <div class="person-block__online">
                                    Був на сайті 8 год тому
                                </div>
                            </div>
                        </div>
                        <div class="star star-4">
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                        </div>
                        <div class="person-info">
                            <div class="person-info__reviews">3</div>
                            <div class="person-info__like">95%</div>
                        </div>
                        <a href="#" class="person-row__btn btn btn--orange">
                            {{ trans('main.order') }}
                        </a>
                    </div>
                    <div class="person-row row-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="img/person-block-img4.png" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    Perry Jackson
                                </div>
                                <div class="person-block__online">
                                    Був на сайті 8 год тому
                                </div>
                            </div>
                        </div>
                        <div class="star star-4">
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                        </div>
                        <div class="person-info">
                            <div class="person-info__reviews">3</div>
                            <div class="person-info__like">95%</div>
                        </div>
                        <a href="#" class="person-row__btn btn btn--orange">
                            {{ trans('main.order') }}
                        </a>
                    </div>
                    <div class="person-row row-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="img/person-block-img4.png" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    Perry Jackson
                                </div>
                                <div class="person-block__online">
                                    Був на сайті 8 год тому
                                </div>
                            </div>
                        </div>
                        <div class="star star-4">
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                        </div>
                        <div class="person-info">
                            <div class="person-info__reviews">3</div>
                            <div class="person-info__like">95%</div>
                        </div>
                        <a href="#" class="person-row__btn btn btn--orange">
                            {{ trans('main.order') }}
                        </a>
                    </div>
                    <div class="person-row row-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="img/person-block-img4.png" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    Perry Jackson
                                </div>
                                <div class="person-block__online">
                                    Був на сайті 8 год тому
                                </div>
                            </div>
                        </div>
                        <div class="star star-4">
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                        </div>
                        <div class="person-info">
                            <div class="person-info__reviews">3</div>
                            <div class="person-info__like">95%</div>
                        </div>
                        <a href="#" class="person-row__btn btn btn--orange">
                            Замовити
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection