@extends('layouts.app')

@section('content')
    <section class="promo">
        <img class="promo__bg" src="img/promo-bg.jpg" alt="img">
        <div class="container">
            <h1 class="promo__title">
                <span>{{ trans('main.banner_text_1') }}</span> <br>
                {{ trans('main.banner_text_2') }}
            </h1>
            <form action="#" class="search">
                <input class="search__input" type="text">
                <button class="search__btn"></button>
            </form>
            <div class="promo-btns">
                <a href="{{ url('/orders') }}" class="promo__btn btn btn--purple">{{ trans('main.find_work') }}</a>
                <a href="#" class="promo__btn btn btn--purple">{{ trans('main.find_employee') }}</a>
            </div>
        </div>
    </section>

    <section class="category sec-marg">
        <div class="container category__wrapper">
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Ремонт побутової
                    техніки
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
            <a href="#" class="category-item">
                <div class="category-item__text">
                    Загальна категорія
                </div>
                <div class="category-item__num">
                    45
                </div>
            </a>
        </div>
    </section>

    <section class="offers sec-marg">
        <div class="container">
            <h2 class="offers__title title">
                {{ trans('main.latest_offers') }}
            </h2>
            <div class="offers__wrapper">
                <div class="offers-row row-item">
                    <div class="offers-row-left">
                        <div class="offers-row-left__top">
                            Розробка логотипу
                        </div>
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="img/person-block-img.png" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    Jennifer Miller
                                </div>
                                <div class="person-block__online">
                                    Був на сайті 8 год тому
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offers-row-center">
                        <div>
                            {{ trans('main.perform') }} <span>10 червня</span>
                        </div>
                        <div>
                            {{ trans('main.status') }}: <span>Очікує спеціаліста</span>
                        </div>
                    </div>
                    <div class="offers-row-right">
                        <div class="offers-row__price">
                            € <span>1000</span>
                        </div>
                        <a href="#" class="offers-row__btn btn btn--orange">
                            {{ trans('main.review') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-work sec-marg">
        <div class="container">
            <h2 class="how-work__title title">
                {{ trans('main.how_it_works') }}
            </h2>
            <div class="how-work__wrapper">
                <div class="how-work-item">
                    <div class="how-work-item__icon">
                        <img loading="lazy" src="img/how-work-item-icon.svg" alt="img">
                    </div>
                    <div class="how-work-item__title">
                        {{ trans('main.create_order') }}
                    </div>
                </div>
                <div class="how-work-item">
                    <div class="how-work-item__icon">
                        <img loading="lazy" src="img/how-work-item-icon2.svg" alt="img">
                    </div>
                    <div class="how-work-item__title">
                        {{ trans('main.choose_specialist') }}
                    </div>
                </div>
                <div class="how-work-item">
                    <div class="how-work-item__icon">
                        <img loading="lazy" src="img/how-work-item-icon3.svg" alt="img">
                    </div>
                    <div class="how-work-item__title">
                        {{ trans('main.close_order') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="how-work__bottom">
            <div class="container">
                {{ trans('main.create_your_order') }}
                <a href="#" class="how-work__btn btn btn--orange">
                    {{ trans('main.create') }}
                </a>
            </div>
        </div>
    </section>

    <section class="reviews sec-marg">
        <div class="container">
            <h2 class="reviews__title title">
                {{ trans('main.user_reviews') }}
            </h2>
            <div class="reviews__wrapper">
                <div class="swiper reviews-swiper">
                    <div class="swiper-wrapper">
                        @for($i = 0; $i < 4; $i++)
                        <div class="swiper-slide">
                            <div class="reviews-item">
                                <div class="reviews-item__top">
                                    <div class="person-block">
                                        <div class="person-block__img">
                                            <img loading="lazy" src="img/person-block-img3.png" alt="img">
                                        </div>
                                        <div class="person-block__info">
                                            <div class="person-block__name">
                                                John Doe
                                            </div>
                                            <div class="person-block__online">
                                                Будівельник
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reviews-item__top--icon">
                                        <img loading="lazy" src="img/reviews-item-icon.svg" alt="img">
                                    </div>
                                </div>
                                <div class="reviews-item__bottom">
                                    <div class="reviews-item__icon">
                                        <img loading="lazy" src="img/reviews-item-icon2.svg" alt="img">
                                    </div>
                                    <div class="reviews-item__descr">
                                        В условиях большого города, беготни и вечного балансирования "сколько стоит
                                        моё время" для меня этот сайт -
                                        палочка-выручалочка. 3 минуты на создание заказа, 1 телефонный звонок с
                                        специалистом, около часа его работы и все
                                        счастливы!
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <section class="app">
        <div class="container app__wrapper">
            <div class="app__left">
                <div class="app__text">
                    {{ trans('main.miss_opportunities_text') }}  <br>
                    <span>{{ trans('main.download_app') }}</span>
                </div>
                <div class="app__download">
                    <a href="#">
                        <img loading="lazy" src="img/download-img.png" alt="img">
                    </a>
                    <a href="#">
                        <img loading="lazy" src="img/download-img2.png" alt="img">
                    </a>
                </div>
            </div>
            <div class="app__img">
                <img loading="lazy" src="img/app-img.png" alt="img">
            </div>
        </div>
    </section>
@endsection
