@extends('layouts.app')
@section('content')
    <div class="top-ban active-orders-ban">
        <div class="container">
            <div class="active-orders-top">
                <h1 class="top-ban__title">{{ trans('main.find_work') }}</h1>
            </div>
        </div>
    </div>

    <section class="active-orders">
        <div class="container">
            <form class="filters-form" action="{{ route('orders') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="input-block m-auto">
                            <div class="form-block-title">
                                {{ trans('main.search_by_title') }}
                            </div>
                            <input name="title" class="input" type="text" value="{{ request()->get('title') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-block m-auto">
                            <div class="form-block-title">
                                {{ trans('main.execute_to') }}
                            </div>
                            <input type="date" name="execute_to" class="input" type="text" value="{{ request()->get('execute_to') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="select-block m-auto">
                            <div class="form-block-title">{{ trans('main.status') }}:</div>
                            <div class="custom-select">
                                <div class="custom-select__top">
                                    <div class="custom-select-value">{{ request()->get('status') ?  trans('main.' . request()->get('status')) : trans('main.choose_status') }}</div>
                                    <input name="status" class="custom-select-input" value="{{ request()->get('status') }}" type="hidden" placeholder="Выберите категорию">
                                </div>
                                <div class="statuses-list custom-select__list">
                                    @foreach($statuses as $status)
                                        <input id="status-name" type="hidden" value="{{ $status }}">
                                        <div class="custom-select-item">
                                            {{ trans('main.' . $status) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-block m-auto">
                            <div class="form-block-title">
                                {{ trans('main.city') }}
                            </div>
                            <input type="hidden" name="city_id" id="city-id" value="{{ request()->get('city_id') }}">
                            <input id="city-search" name="city" value="{{ request()->get('city')  }}" class="input executors-city-search" type="text">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="select-block m-auto">
                            <div class="form-block-title">{{ trans('main.section') }}:</div>
                            <div class="custom-select">
                                <div class="custom-select__top">
                                    <div class="custom-select-value">{{ request()->get('section_id') ? $sections[request()->get('section_id')]->name : trans('main.choose_section') }}</div>
                                    <input name="section_id" class="custom-select-input" value="{{ request()->get('section_id') }}" type="hidden" placeholder="Выберите категорию">
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
                    </div>
                    <div class="col-md-4">
                        <div class="select-block m-auto">
                            <div class="form-block-title">{{ trans('main.category') }}:</div>
                            <div class="custom-select">
                                <div class="custom-select__top">
                                    <div class="custom-select-value category-value">{{ request()->get('category_id') ? $categories[request()->get('category_id')]->name : trans('main.choose_category') }}</div>
                                    <input name="category_id" class="custom-select-input category-input" value="{{ request()->get('category_id') }}" type="hidden" placeholder="Оберіть категорію">
                                </div>
                                <div class="categories-list custom-select__list">
                                    @foreach($categories as $category)
                                        <div id="{{ $category->id }}" class="custom-select-item">
                                            {{$category->name}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-block m-auto">
                            <div class="form-block-title">
                                {{ trans('main.price_from') }}
                            </div>
                            <input value="{{ request()->get('price_from') }}" name="price_from" class="input" type="text">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-block m-auto">
                            <div class="form-block-title">
                                {{ trans('main.price_to') }}
                            </div>
                            <input name="price_to" value="{{ request()->get('price_to') }}" class="input" type="text">
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="search-filter-row__btn btn btn--orange m-auto">
                    {{ trans('main.search') }}
                </button>
            </form>
        </div>
        <br>
        <div class="container">
            <h2 class="active-orders__title title">
                {{ trans('main.latest_offers') }}
            </h2>
            <div class="active-orders__wrapper">
                @foreach($orders as $order)
                    <div class="offers-row row-item">
                        <div class="offers-row-left">
                            <div class="offers-row-left__top">
                                {{$order->short_description}}
                            </div>
                            <div class="person-block">
                                <div class="person-block__img">
                                    <img loading="lazy" src="img/person-block-img.png" alt="img">
                                </div>
                                <div class="person-block__info">
                                    <div class="person-block__name">
                                        <a class="profile-link" href="{{ route('show-user', $order->author->id) }}">
                                            {{ $order->author->name . ' ' . $order->author->surname }}
                                        </a>
                                    </div>
                                    <div class="person-block__online">
                                        {{ $order->author->lastSeen() }}
                                    </div>
                                </div>
                            </div>
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
            {{ $orders->links() }}
        </div>
    </section>
@endsection