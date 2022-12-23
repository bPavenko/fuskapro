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
                 <a href="{{ route('create-orders') }}" class="promo__btn btn btn--purple">
                     {{ trans('main.create-order') }}
                 </a>
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
{{--                @if(count($section->orders))--}}
                    <div  class="category-item">
                        <div class="section-item">
                            <div class="person-block">
                            <div class="person-block__img category-item-img">
                                <img loading="lazy" src="{{ $section->image_path }}" alt="img">
                            </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <a href="{{ route('orders', ['section_id' =>  $section->id]) }}" class="category-item__text">
                                        {{ $section->name }}
                                    </a>
                                </div>
                            </div>
{{--                            <div class="category-item__num">--}}
{{--                                {{ count($section->orders) }}--}}
{{--                            </div>--}}
                        </div>
                        <div class="category-items">
                            @isset($section->categories[0])
                            <div class="row">
                                <a href="{{ route('orders', ['section_id' =>  $section->id]) }}"> {{ $section->categories[0]->name }} ({{count($section->categories[0]->orders)}}) </a>
                            </div>
                            @endisset
                            @isset($section->categories[1])
                            <div class="row">
                                <a href="{{ route('orders', ['section_id' =>  $section->id]) }}"> {{ $section->categories[1]->name }} ({{count($section->categories[1]->orders)}}) </a>
                            </div>
                            @endisset
                            @if(count($section->categories) > 2)
                                <div class="show-more">
                                    {{ trans('main.show_more') }}
                                </div>
                                <div class="hidden-categories" hidden>
                                    @foreach($section->categories as $key => $category )
                                        @if($key > 1)
                                        <div class="row">
                                            <a href="{{ route('orders', ['section_id' =>  $section->id, 'category_id' => $category->id]) }}"> {{ $category->name }} ({{count($category->orders)}})  </a>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
{{--                @endif--}}
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
                        <div class="section-item">
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
                <a href="{{ route('create-orders') }}" class="how-work__btn btn btn--orange">
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
                        @foreach($reviews as $review)
                        <div class="swiper-slide">
                            <div class="reviews-item">
                                <div class="reviews-item__top">
                                    <div class="person-block">
                                        <div class="person-block__img">
                                            <img loading="lazy" src="{{ $review->image_path }}" alt="img">
                                        </div>
                                        <div class="person-block__info">
                                            <div class="person-block__name">
                                                {{ $review->name }}
                                            </div>
                                            <div class="person-block__online">
                                                {{ $review->profession }}
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
                                        {{ $review->review }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                    <a href="{{ $links[0]->url }}">
                        <img loading="lazy" src="img/download-img.png" alt="img">
                    </a>
                    <a href="{{ $links[1]->url }}">
                        <img loading="lazy" src="img/download-img2.png" alt="img">
                    </a>
                </div>
            </div>
            <div class="app__img">
                <img loading="lazy" src="img/app-img-2.png" alt="img">
            </div>
        </div>
    </section>
@endsection

