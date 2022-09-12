@extends('layouts.app')
@section('content')
    <div class="top-ban active-orders-ban">
        <div class="container">
            <div class="active-orders-top">
                <h1 class="top-ban__title">{{trans('main.create_new_order')}}</h1>
                <a href="{{ url('/create-order') }}" class="top-ban__btn btn btn--purple">{{trans('main.create_order')}}</a>
            </div>
        </div>
    </div>

    <section class="active-orders">
        <div class="container">
            <h2 class="active-orders__title title">
                {{ trans('main.my_orders') }}
            </h2>
            <div class="active-orders__wrapper">
                @foreach($orders as $order)
                    <div class="offers-row row-item">
                        <div class="offers-row-left">
                            <div class="offers-row-left__top">
                                {{$order->short_description}}
                            </div>
                            <p>
                                {{ trans('main.order_executor') }}: <span> {{ isset($order->executor->name) ? $order->executor->name : '-' }} </span>
                            </p>
                        </div>
                        <div class="offers-row-center">
                            <div>
                                {{ trans('main.status') }}: <span> {{ trans('main.' . $order->status) }} </span>
                            </div>
                            <div>
                                {{ trans('main.execute_to') }}: <span> {{ $order->execution_date->format('d/m/Y') }} </span>
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
            <a href="#" class="active-orders__btn btn btn--grey">
                {{ trans('main.archive_orders') }}
            </a>
        </div>
    </section>
@endsection