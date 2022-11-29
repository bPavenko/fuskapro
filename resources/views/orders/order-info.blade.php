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
                                <span>{{ $order->count_views }}</span>
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
                                <span>{{ date('Y-m-d', strtotime($order->execution_date)) }}</span>
                            </div>
                        </div>

                        <div class="price-block">
                            <div class="price-item"><span>€</span> {{ $order->price }}</div>
                        </div>
                        @if($order->price_negotiable)
                            <div class="order-box-item">
                                <div>
                                    <span>{{ trans('main.price_negotiable') }}</span>
                                </div>
                            </div>
                        @endif
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
                        @if(Auth::user() && Auth::user()->isAuthor($order->id))
                        <div class="specialist__name">
                                {{ trans('main.select_executor') }}
                        </div>
                        @endif
                        <div class="specialist__responded">
                            {{ trans('main.specialists_responded') }}: <span> {{ count($order->order_requests) }}</span>
                        </div>
                    </div>
                @else
                    <div class="specialist">
                        <div class="specialist__title">
                            {{ trans('main.selected_specialist') }}
                        </div>
                        <div class="specialist__img">
                            <img loading="lazy" src="{{$order->executor->avatar_path}}" alt="img">
                        </div>
                        <div class="specialist__name">
                            <a class="profile-link" href="{{ route('show-user', $order->executor->id) }}">
                                {{ $order->executor->name . ' ' . $order->executor->surname }}
                            </a>
                        </div>
                        <div class="specialist-info">
                            <div class="specialist-info-item">
                                <div class="specialist-info-item__num">
                                    {{ count($order->executor->rates) }}
                                </div>
                                <a href="#" class="specialist-info-item__text">
                                    {{ trans('main.rates_count') }}
                                </a>
                            </div>
                            <div class="specialist-info-item">
                                <div class="specialist-info-item__num">
                                    {{ $order->executor->getRate() }}
                                </div>
                                <div class="specialist-info-item__text">
                                    {{ trans('main.rate') }}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="star {{ 'star-' . intval($order->executor->getRate()) }}">
                            <div id="star-1" class="star-item"></div>
                            <div id="star-2" class="star-item"></div>
                            <div id="star-3" class="star-item"></div>
                            <div id="star-4" class="star-item"></div>
                            <div id="star-5" class="star-item"></div>
                        </div>
                        <div class="specialist__bottom">
                            <div>{{ trans('main.closed_orders') }}: <span>{{ $order->executor->closedOrders() }}</span></div>
                            <div>{{ trans('main.active_orders') }}:: <span>{{ $order->executor->activeOrders() }}</span></div>
                        </div>
                    </div>
                    @endif
            </div>
            @if(Auth::user() && !Auth::user()->isAuthor($order->id))
                @if (!$order->checkRequest(Auth::user()->id, 'show'))
                    <div class="specialist-contact specialist-contact-payment">
                        <div class="specialist-contact__left">
                            <div class="specialist-contact__title">{{ trans('main.show_contacts') }}</div>
                            <div class="specialist-contact__subtitle">{{ \App\Models\Price::contactShowText() }}</div>
                        </div>
                        <button class="specialist-contact__btn btn btn--orange">
                            {{ trans('main.display') }}
                        </button>
                    </div>
                @endif
                <div class="specialist-contact specialist-contact-show" @if(!$order->checkRequest(Auth::user()->id, 'show')) hidden @endif>
                    <div class="specialist-contact__left">
                        <div class="specialist-contact__title">{{ trans('main.show_contacts') }}</div>
                        <div class="specialist-contact__subtitle">{{ trans('main.cost_per_action') }}</div>
                    </div>
                    <div class="specialist-contact__center">
                        <a href="tel:380989140248">{{ $order->author->phone }}</a>
                        <a href="">{{ $order->author->email }}</a>
                    </div>
                    <br>
                    <a href="#" class="btn btn--grey">
                        {{trans('main.displayed')}}
                    </a>
                </div>
            @endif

            <div class="order-info-btns">
                @if($order->status != 'closed')
                    @if(Auth::user())
                        @if(Auth::user()->isAuthor($order->id))
                            @if($order->checkRequest(null, 'close'))
                                <a href="{{ route('close-order', ['order_id' => $order->id]) }}" class="order-info__btn btn btn--purple">{{ trans('main.close_as_done') }}</a>
                            @endif
                            @if($order->executor_id)
                                <a href="{{route('order-respond-change', ['order_id' => $order->id, 'executor_id' => $order->executor_id, 'author_id' => $order->by_user])}}" class="order-info__btn btn btn--orange-border">{{ trans('main.change_specialist') }}</a>
                            @endif
                            <a href="#" class="order-info__btn btn btn--orange-border">{{ trans('main.continue_order') }}</a>
                            <a href="#" class="order-info__btn btn btn--purple-border">{{ trans('main.delete') }}</a>
                        @elseif (Auth::user()->isExecutor($order->id))
                        @if (!$order->checkRequest(Auth::user()->id, 'close'))
                            <div class="order-respond-close__btn btn btn--purple">{{ trans('main.close_as_done') }}</div>
                        @endif
                        <div class="btn order-respond-close btn--grey" @if(!$order->checkRequest(Auth::user()->id, 'close')) hidden @endif>{{ trans('main.responded') }}</div>
                        @else
                            @if (!$order->checkRequest(Auth::user()->id, 'request') && Auth::user()->isSpecialist())
                                <div class="order-respond__btn btn btn--purple">{{ trans('main.respond') }}</div>
                            @endif
                            <div class="btn order-responded btn--grey" @if(!$order->checkRequest(Auth::user()->id, 'request')) hidden @endif>{{ trans('main.responded') }}</div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn--purple">{{ trans('main.respond') }}</a>
                    @endif
                @else
                    <div href="" class="btn btn--grey">{{ trans('main.closed') }}</div>
                @endif


            </div>
        </div>
    </div>
    @if (Auth::user() && Auth::user()->isAuthor($order->id) && !$order->executor_id)
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
                                    <a class="profile-link" href="{{ route('show-user', $request->executor->id) }}">
                                    {{ $request->executor->name . ' ' . $request->executor->surname }}
                                    </a>
                                </div>
                                <div class="person-block__online">
                                    {{ $request->executor->lastSeen() }}
                                </div>
                            </div>
                        </div>
                        <div class="star {{ 'star-' . intval($request->executor->getRate()) }}">
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                            <div class="star-item"></div>
                        </div>
                        <div class="specialist-info-item">
                            <div class="specialist-info-item__num">
                                {{ $request->executor->getRate() }}
                            </div>
                            <div class="specialist-info-item__text">
                                {{ trans('main.rate') }}
                            </div>
                        </div>
                        <div class="specialist-info-item">
                            <div class="specialist-info-item__num">
                                {{ count($request->executor->rates) }}
                            </div>
                            <a href="#" class="specialist-info-item__text">
                                {{ trans('main.rates_count') }}
                            </a>
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
    <script>

        $('.specialist-contact__btn').click(function(event){
            var order_id = $(this).parents('.order-info').find('#order-id').val();
            event.preventDefault();
            swal({
                title: "{{ trans('main.payment_confirmation') }}",
                text: "{{ \App\Models\Price::contactShowText() }}",
                icon: "warning",
                type: "warning",
                buttons: ["{{ trans('main.cancel') }}","{{ trans('main.yes') }}!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((confirm) => {
                if (confirm) {
                    $.ajax({
                        url: "/order-respond/create",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: order_id,
                            type: 'show'
                        },
                        dataType: 'json',
                        success: function success() {
                            $(".specialist-contact-payment").hide();
                            $(".specialist-contact-show").removeAttr('hidden');
                        }
                    });
                }
            });
        });
    </script>
@endsection