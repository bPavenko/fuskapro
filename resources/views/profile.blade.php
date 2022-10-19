@extends('layouts.app')

@section('content')
    <div class="profile">
        <div class="container">
            <div class="profile-top">
                <div class="person-block">
                    <div class="person-block__img">
                        <img loading="lazy" src="{{URL::asset('img/person-block-img4.png')}}" alt="img">
                    </div>
                    <div class="person-block__info">
                        <div class="person-block__name">
                            {{$user->name . ' ' . $user->surname}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-wrapper tab-link-wrapper">
                <a class="tab tab-active" href="#tab-1">
                    {{ trans('main.general_information') }}
                </a>
                <a class="tab" href="#tab-2">
                    {{ trans('main.portfolio') }}
                </a>
            </div>
            <div class="tabs-wrapper tab-content-wrapper">
                <div id="tab-1" class="tabs-content tabs-content-active">
                    <div class="general-information">
                        <div class="order-box">
                            <div class="order-box-item">
                                <div class="order-box-item__icon">
                                    <img loading="lazy" src="{{URL::asset('img/order-box-item-icon4.svg')}}" alt="img">
                                </div>
                                <div>
                                    {{ trans('main.city') }}:
                                    <span>{{$user->cityName}}</span>
                                </div>
                            </div>
                            <div class="order-box-item">
                                <div class="order-box-item__icon">
                                    <img loading="lazy" src="{{URL::asset('img/order-box-item-icon5.svg')}}" alt="img">
                                </div>
                                <div>
                                    {{ trans('main.date_birth') }}:
                                    <span>{{ $user->date_birth }}</span>
                                </div>
                            </div>
                            <div class="order-box-item">
                                <div class="order-box-item__icon">
                                    <img loading="lazy" src="{{URL::asset('img/order-box-item-icon6.svg')}}" alt="img">
                                </div>
                                <div>
                                    {{ trans('main.gender') }}:
                                    <span>{{ trans('main.' . $user->gender) }}</span>
                                </div>
                            </div>
                        </div>
                        <h4>{{ trans('main.about_me') }}:</h4>
                        <p>
                            {{ $user->about_me }}
                        </p>
                        <h4>{{ trans('main.orders_categories') }}:</h4>
                        <div class="purple-block-wrap">
                            @foreach($user->categories as $category)
                                <span class="purple-block">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @if(Auth::user() && Auth::user()->id != $user->id)
                        @if (!Auth::user()->checkRequest($user->id, 'show'))
                            <div class="specialist-contact profile-contact-payment">
                                <div class="specialist-contact__left">
                                    <div class="specialist-contact__title">{{ trans('main.show_contacts') }}</div>
                                    <div class="specialist-contact__subtitle">{{ trans('main.cost_per_action') }}</div>
                                </div>
                                <a id="{{ $user->id }}" href="" class="profile-contact__btn btn btn--orange">
                                    {{ trans('main.price_per_display') }}
                                </a>
                            </div>
                        @endif
                        <div class="specialist-contact profile-contact-show" @if(!Auth::user()->checkRequest($user->id, 'show')) hidden @endif>
                            <div class="specialist-contact__left">
                                <div class="specialist-contact__title">{{ trans('main.show_contacts') }}</div>
                                <div class="specialist-contact__subtitle">{{ trans('main.cost_per_action') }}</div>
                            </div>
                            <div class="specialist-contact__center">
                                <a href="tel:380989140248">{{ $user->phone }}</a>
                                <a href="">{{ $user->email }}</a>
                            </div>
                            <br>
                            <a href="#" class="btn btn--grey">
                                {{trans('main.displayed')}}
                            </a>
                        </div>
                    @endif
                </div>
                <div id="tab-2" class="tabs-content ">
{{--                    <div class="portfolio">--}}
{{--                        <div class="portfolio-catalog-item portfolio-catalog-item--img">--}}
{{--                            <a href="#" class="portfolio-catalog-item__top">--}}
{{--                                <img loading="lazy" src="img/portfolio-catalog-item-img.jpg" alt="img">--}}
{{--                                <div class="portfolio-catalog-item__title">--}}
{{--                                    Логотип для подарункової--}}
{{--                                    компанії--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-catalog-item portfolio-catalog-item--img">--}}
{{--                            <a href="#" class="portfolio-catalog-item__top">--}}
{{--                                <img loading="lazy" src="img/portfolio-catalog-item-img2.jpg" alt="img">--}}
{{--                                <div class="portfolio-catalog-item__title">--}}
{{--                                    Промо ролик для “Eagle Shell”--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

