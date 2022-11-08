@extends('layouts.app')

@section('content')
    <section class="promo">
        <img class="promo__bg" src="img/promo-bg.jpg" alt="img">
        <div class="container">
            <h1 class="promo__title">
                <span>{{ trans('main.banner_text_1') }}</span> <br>
                {{ trans('main.banner_text_2') }}
            </h1>
            <div class="search search-container">
                <input class="search__input search__input_border typeahead form-control" id="search" type="text">
                <button class="search__btn"></button>
            </div>
             <div class="promo-btns">
                <a href="{{ url('/orders') }}" class="promo__btn btn btn--purple">{{ trans('main.find_work') }}</a>
                <a href="{{ url('/executors') }}" class="promo__btn btn btn--purple">{{ trans('main.find_employee') }}</a>
            </div>
        </div>
    </section>
    <br>
    <h2 class="offers__title title">
        {{ trans('main.popular_sections') }}
    </h2>
    <section class="category sec-marg">
        <div class="container category__wrapper">
            @foreach($sections as $section)
                @if(count($section->orders))
                    <a href="{{ route('orders', ['section_id' =>  $section->id]) }}" class="category-item">
                        <div class="col">
                            <div class="row">
                                <div class="category-item__text">
                                    {{ $section->name }}
                                </div>
                            </div>
                        </div>
                        <div class="category-item__num">
                            {{ count($section->orders) }}
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </section>
    <h2 class="offers__title title">
        {{ trans('main.popular_categories') }}
    </h2>
    <section class="category sec-marg">
        <div class="container category__wrapper">
            @foreach($categories as $category)
                @if(count($category->orders))
                    <a href="{{ route('orders', ['section_id' =>  $category->parent_id, 'category_id' => $category->id]) }}" class="category-item">
                        <div class="col">
                            <div class="row">
                                <div class="category-item__text">
                                    {{ $category->name }}
                                </div>
                            </div>
                        </div>
                        <div class="category-item__num">
                            {{ count($category->orders) }}
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </section>
    @if(count($lastUserCategoriesOrders))
        <section class="offers sec-marg">
            <div class="container">
                <h2 class="offers__title title">
                    {{ trans('main.latest_offers') }}
                </h2>
                <div class="offers__wrapper">
                    @foreach($lastUserCategoriesOrders as $order)
                        <div class="offers-row row-item">
                            <div class="offers-row-left">
                                <div class="offers-row-left__top">
                                    {{ $order->title }}
                                </div>
                                <div class="person-block">
                                    <div class="person-block__img">
                                        <img loading="lazy" src="img/person-block-img.png" alt="img">
                                    </div>
                                    <div class="person-block__info">
                                        <div class="person-block__name">
                                            {{ $order->author->name }}
                                        </div>
                                        <div class="person-block__online">
                                            {{ $order->author->lastSeen() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offers-row-center">
                                <div>
                                    {{ trans('main.execute_to') }}: <span> {{ $order->execution_date->format('d/m/Y') }} </span>
                                </div>
                                <div>
                                    {{ trans('main.status') }}: <span> {{ trans('main.' . $order->status) }} </span>
                                </div>
                            </div>
                            <div class="offers-row-right">
                                <div class="offers-row__price">
                                    € <span>{{$order->price}}</span>
                                </div>
                                <a href="{{ route('order-info', ['id' => $order->id]) }}" class="offers-row__btn btn btn--orange">
                                    {{ trans('main.review') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
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

