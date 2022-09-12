@extends('layouts.app')
@section('content')
    <div class="order-info">
        <div class="container">
            <div class="order-info__wrapper">
                <div class="order-info__left">
                    <div class="order-info__top">
                        <input type="hidden" id="order-id" value="{{ $order->id }}">
                        <div class="order-info__title">
                            {{ $order->title }} <span>| {{ $order->section->name }}</span>
                        </div>
                        <div class="order-info__code">
                            #{{ $order->id }}
                        </div>
                    </div>
                    <div class="order-box">
                        <div class="order-box-item">
                            <div class="order-box-item__icon">
                                <img loading="lazy" src="{{URL::asset('/img/order-box-item-icon.svg')}}" alt="img">
                            </div>
                            <div>
                                {{ trans('main.views') }}:
                                <span>56</span>
                            </div>
                        </div>
                        <div class="order-box-item">
                            <div class="order-box-item__icon">
                                <img loading="lazy" src="{{URL::asset('/img/order-box-item-icon2.svg')}}" alt="img">
                            </div>
                            <div>
                                {{ trans('main.status') }}:
                                <span>{{ trans('main.' . $order->status) }}</span>
                            </div>
                        </div>
                        <div class="order-box-item">
                            <div class="order-box-item__icon">
                                <img loading="lazy" src="{{URL::asset('/img/order-box-item-icon3.svg')}}" alt="img">
                            </div>
                            <div>
                                {{ trans('main.execute_to') }}:
                                <span>5 червня</span>
                            </div>
                        </div>
                        <div class="price-block">
                            <div class="price-item"><span>€</span> {{ $order->price }}</div>
                        </div>
                    </div>
                    <div class="order-info-task">
                        <div class="order-info-task-item">
                            {{ trans('main.what_need_to_do') }}:
                            <p>
                                {{ $order->short_description }}
                            </p>
                        </div>
                        <div class="order-info-task-item">
                            {{ trans('main.more_about_order') }}:
                            <p>
                                {{ $order->full_description }}
                            </p>
                        </div>
                    </div>
                </div>
                @if(!$order->executor_id)
                    <div class="specialist specialist-not-select">
                        <div class="specialist__img">
                            <img loading="lazy" src="{{URL::asset('/img/specialist-img.png')}}" alt="img">
                        </div>
                        <div class="specialist__name">
                                {{ trans('main.select_executor') }}
                        </div>
                        <div class="specialist__responded">
                            {{ trans('main.specialists_responded') }}: <span> {{ count($order->order_requests) }}</span>
                        </div>
                    </div>
                @else
                    <div class="specialist">
                        <div class="specialist__title">
                            Вибраний спеціаліст
                        </div>
                        <div class="specialist__img">
                            <img loading="lazy" src="{{URL::asset('/img/specialist-img2.png')}}" alt="img">
                        </div>
                        <div class="specialist__name">
                            {{ $order->executor->name }}
                        </div>
                        <div class="specialist-info">
                            <div class="specialist-info-item specialist-info-item--reviews">
                                <div class="specialist-info-item__num">
                                    22
                                </div>
                                <a href="#" class="specialist-info-item__text">
                                    відгуки
                                </a>
                            </div>
                            <div class="specialist-info-item specialist-info-item--like">
                                <div class="specialist-info-item__num">
                                    95%
                                </div>
                                <div class="specialist-info-item__text">
                                    позитивні
                                </div>
                            </div>
                        </div>
                        <div class="specialist__bottom">
                            <div>Закрито замовлень: <span>22</span></div>
                            <div>Активних замовлень: <span>3</span></div>
                        </div>
                    </div>
                    @endif
            </div>
            @if(!Auth::user()->isAuthor($order->id))
            <div class="specialist-contact specialist-contact-payment">
                <div class="specialist-contact__left">
                    <div class="specialist-contact__title">{{ trans('main.show_contacts') }}</div>
                    <div class="specialist-contact__subtitle">{{ trans('main.cost_per_action') }}</div>
                </div>
                <a href="#" class="specialist-contact__btn btn btn--orange">
                    {{ trans('main.price_per_display') }}
                </a>
            </div>
            <div class="specialist-contact specialist-contact-show" hidden>
                <div class="specialist-contact__left">
                    <div class="specialist-contact__title">{{ trans('main.show_contacts') }}</div>
                    <div class="specialist-contact__subtitle">{{ trans('main.cost_per_action') }}</div>
                </div>
                <div class="specialist-contact__center">
                    <a href="tel:380989140248">Тел. +38 (098) 914 02 48</a>
                    <a href="perryj99@gmail.com">E-mail: test@test.com</a>
                </div>
                <a href="#" class="specialist-contact__btn btn btn--grey">
                    {{trans('main.displayed')}}
                </a>
            </div>
            @endif
            <div class="order-info-btns">
                @if(Auth::user()->isAuthor($order->id)))
                    <a href="#" class="order-info__btn btn btn--purple">{{ trans('main.close_as_done') }}</a>
                    @if($order->executor_id)
                    <a href="{{route('order-respond-change', ['order_id' => $order->id, 'executor_id' => $order->executor_id, 'author_id' => $order->by_user])}}" class="order-info__btn btn btn--orange-border">{{ trans('main.change_specialist') }}</a>
                    @endif
                    <a href="#" class="order-info__btn btn btn--orange-border">{{ trans('main.continue_order') }}</a>
                    <a href="#" class="order-info__btn btn btn--purple-border">{{ trans('main.delete') }}</a>
                @else
                    <a href="#" class="order-respond__btn btn btn--purple">{{ trans('main.respond') }}</a>
                    <div class="order-responded order-box-item" hidden>{{ trans('main.responded') }}</div>
                @endif
            </div>
        </div>
    </div>
    @if (Auth::user()->isAuthor($order->id) && !$order->executor_id)
    <div class="offers-specialist">
        <div class="container">
            <h2 class="offers-specialist__title title">
                {{ trans('main.suggestions_from_specialists') }}:
            </h2>
            <div class="offers-specialist__wrapper">
                @foreach($order->order_requests as $request)
                    <div class="person-row row-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="{{URL::asset('/img/person-block-img4.png')}}" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    {{ $request->executor->name }}
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
                        <a href="{{ route('order-respond-accept', ['order_id' => $order->id, 'executor_id' => $request->executor->id, 'author_id' => $order->by_user]) }}" class="person-row__btn btn btn--orange">
                            {{ trans('main.order') }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection