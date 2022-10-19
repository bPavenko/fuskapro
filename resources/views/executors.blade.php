@extends('layouts.app')
@section('content')
    <div class="top-ban active-orders-ban">
        <div class="container">
            <div class="active-orders-top">
                <h1 class="top-ban__title">{{ trans('main.find_work') }}</h1>
            </div>
        </div>
    </div>
    <form class="sort">
        <div class="container">
            <div class="custom-select sort-select">
                <div class="custom-select__top">
                    <div class="custom-select-value">{{ trans('main.section') }}</div>
                    <input class="section-input custom-select-input" type="hidden" value="">
                </div>
                <div class="sections-list custom-select__list">
                    @foreach($sections as $section)
                        <div id="{{ $section->id }}" class="section-filter-item custom-select-item">
                            {{ $section->name }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="custom-select sort-select">
                <div class="custom-select__top">
                    <div class="custom-select-value">{{ trans('main.category') }}</div>
                    <input class="category-input custom-select-input" type="hidden" value="">
                </div>
                <div class="categories-list categories-filters-list custom-select__list">

                </div>
            </div>
            <div class="city-input">
                <input type="hidden" id="city-id" value="">
                <input id="city-search" name="price_to" value="{{ request()->get('price_to') }}" placeholder="{{trans('main.city')}}" class="input executors-city-search" type="text">
            </div>
            <div class="sort-radio-wrap">
                <label class="sort-radio active">
                    <input id="created_at" сhecked class="sort-radio-input" type="radio" name="sort">
                    {{ trans('main.by_date') }}
                </label>
                <label class="sort-radio">
                    <input id="rate" class="sort-radio-input" type="radio" name="sort">
                    {{ trans('main.by_rate') }}
                </label>
                <label class="sort-radio">
                    <input id="rate_counts" class="sort-radio-input" type="radio" name="sort">
                    {{ trans('main.by_rates_count') }}
                </label>
            </div>
        </div>
    </form>
    <section class="active-orders">
        <div class="container">
            <div class="active-orders__wrapper executors-list">
                @include('includes.executors', ['executors' => $executors])
            </div>
        </div>
    </section>
@endsection