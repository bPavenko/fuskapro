@extends('layouts.app')
@section('content')
    <section class="notification">
        <div class="container">
            <h2 class="notification__title title">
                {{ trans('main.notifications') }}
            </h2>
            <div class="notification__wrapper">
                @foreach($notifications as $notification)
                    @if ($notification->from)
                    <a href="{{ route('order-info', ['id' => $notification->order_id]) }}" class="notification-item">
                        <div class="person-block">
                            <div class="person-block__img">
                                <img loading="lazy" src="{{ $notification->from_user->avatar_path }}" alt="img">
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
                        @if ($notification->type == 'rate')
                            <div class="star stars-rating">
                                <a href="{{ route('rate-user', ['order_id' => $notification->order_id, 'user_id' => $notification->from_user->id, 'notification_id' => $notification->id, 'rate' => 1]) }}" id="star-2" class="star-item star-rate"></a>
                                <a href="{{ route('rate-user', ['order_id' => $notification->order_id, 'user_id' => $notification->from_user->id, 'notification_id' => $notification->id, 'rate' => 2]) }}" id="star-3" class="star-item star-rate"></a>
                                <a href="{{ route('rate-user', ['order_id' => $notification->order_id, 'user_id' => $notification->from_user->id, 'notification_id' => $notification->id, 'rate' => 3]) }}" id="star-4" class="star-item star-rate"></a>
                                <a href="{{ route('rate-user', ['order_id' => $notification->order_id, 'user_id' => $notification->from_user->id, 'notification_id' => $notification->id, 'rate' => 4]) }}" id="star-5" class="star-item star-rate"></a>
                                <a href="{{ route('rate-user', ['order_id' => $notification->order_id, 'user_id' => $notification->from_user->id, 'notification_id' => $notification->id, 'rate' => 5]) }}" id="star-6" class="star-item star-rate"></a>
                            </div>
                        @endif
                    </a>
                    @else
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
                                        {{ $notification->notification }}
                                    </div>
                                </div>
                            </div>
                            <div class="notification-item__date">
                                {{ $notification->created_at }}
                            </div>
                        </a>
                    @endif
                @endforeach
                @if(!count($notifications))
                    <h1 class="empty-items-text title">
                        {{ trans('main.no_notifications') }}
                    </h1>
                @endif
            </div>
            <a href="#" class="notification__btn btn btn--grey">
                {{ trans('main.archive_notifications') }}
            </a>
        </div>
    </section>
@endsection