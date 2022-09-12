@extends('layouts.app')
@section('content')
    <section class="notification">
        <div class="container">
            <h2 class="notification__title title">
                {{ trans('main.notifications') }}
            </h2>
            <div class="notification__wrapper">
                @foreach(Auth::user()->notifications as $notification)
                    <a href="{{ route('order-info', ['id' => $notification->order_id]) }}" class="notification-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="img/person-block-img5.png" alt="img">
                            </div>
                            <div class="person-block__info">
                                <div class="person-block__name">
                                    {{ $notification->from_user->name }}
                                </div>
                                <div class="person-block__online">
                                    {{ $notification->notification }}
                                </div>
                            </div>
                        </div>
                        <div class="notification-item__date">
                            {{ $notification->created_at }}
                        </div>
                    </a>
                @endforeach

                <a href="#" class="notification-item">
                    <div class="person-block">
                        <div class="person-block__img">
                            <img loading="lazy" src="img/person-block-img6.png" alt="img">
                        </div>
                        <div class="person-block__info">
                            <div class="person-block__name">
                                Сайт послуг
                            </div>
                            <div class="person-block__online">
                                Рахунок був поповнений на <span>20 монет</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-item__date">
                        30.05.22
                    </div>
                </a>
            </div>
            <a href="#" class="notification__btn btn btn--grey">
                {{ trans('main.archive_notifications') }}
            </a>
        </div>
    </section>
@endsection