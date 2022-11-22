@extends('layouts.app')

@section('content')
    <div class="profile">
        <div class="container">
            <div class="profile-top">
                <div class="person-block">
                    <div class="person-block__img">
                        <img loading="lazy" src="{{ $user->avatar_path }}" alt="img">
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
                                    <span>@if($user->gender){{ trans('main.' . $user->gender) }} @endif</span>
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
                                    <div class="specialist-contact__subtitle">{{ \App\Models\Price::contactShowText() }}</div>
                                </div>
                                <button id="{{ $user->id }}" class="profile-contact__btn btn btn--orange">
                                    {{ trans('main.display') }}
                                </button>
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
                            <a href="#" text="{{ $user->phone }}" class="btn btn--grey copy-text">
                                {{trans('main.copy')}}
                            </a>
                        </div>
                    @endif
                </div>
                <div id="tab-2" class="tabs-content ">
                    @include('includes.user-portfolio');
                </div>
            </div>
        </div>
    </div>
    @include('modals.edit-portfolio-img')
    @include('modals.edit-portfolio-video')
    <script type="text/javascript">
        $('.profile-contact__btn').click(function(event){
            connsole.log('here')
            var profile_id = $(this).attr('id');
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
                        url: "/user-request/create",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            profile_id: profile_id,
                            type: 'show'
                        },
                        dataType: 'json',
                        success: function success() {
                            $(".profile-contact-payment").hide();
                            $(".profile-contact-show").removeAttr('hidden');
                        }
                    });
                }
            });
        });
    </script>
@endsection

