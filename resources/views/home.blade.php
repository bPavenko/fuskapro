@extends('layouts.app')

@section('content')
    <div class="profile">
        <div class="container">
            <div class="profile-top user-profile">
                <div class="person-block">
                    <div class="person-block__img">
                        <img loading="lazy" src="{{ Auth::user()->avatar_path }}" alt="img">
                    </div>
                    <div class="person-block__info">
                        <div class="person-block__name">
                            {{Auth::user()->name . ' ' . Auth::user()->surname}}
                        </div>
                        @if(Auth::user()->vip_status)
                            <div>
                                {{ trans('main.vip_status_to' )}}: {{ Auth::user()->vip_status }}
                            </div>
                        @endif

                    </div>
                </div>
                <button class="btn btn--purple edit-profile">{{ trans('main.edit') }}</button>
            </div>
            <div class="tabs-wrapper tab-link-wrapper">
                <a class="tab  @if(!session('active_tabs')) tab-active @endif" href="#tab-1">
                    {{ trans('main.general_information') }}
                </a>
                <a class="tab @if(isset(session('active_tabs')['portfolio'])) tab-active @endif" href="#tab-2">
                    {{ trans('main.portfolio') }}
                </a>
                <a class="tab  @if(isset(session('active_tabs')['password'])) tab-active @endif" href="#tab-3">
                    {{ trans('main.change_password') }}
                </a>
                <a class="tab" href="#tab-4">
                    {{ trans('main.change_categories') }}
                </a>
            </div>
            <div class="tabs-wrapper tab-content-wrapper">
                <div id="tab-1" class="tabs-content @if(!session('active_tabs')) tabs-content-active @endif">
                    @include('includes.personal-info');
                </div>
                <div id="tab-2" class="tabs-content @if(isset(session('active_tabs')['portfolio'])) tabs-content-active @endif">
                    @include('includes.portfolio');
                </div>
                <div id="tab-3" class="tabs-content @if(isset(session('active_tabs')['password'])) tabs-content-active @endif">
                    @include('includes.change-password')
                </div>
                <div id="tab-4" class="tabs-content">
                    @include('includes.user-categories')
                </div>
            </div>
        </div>
    </div>
    <div class="modal-wrap modal-password">
        <div class="modal modal-password-edit">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-password-edit__title">
                    {{ trans('main.success') }}
                </div>
                <div class="modal-password-edit__descr">
                    {{ trans('main.success_change_password') }}.
                </div>
                <button class="modal-password-edit__btn btn btn--purple close-modal">
                    {{ trans('main.accept') }}
                </button>
            </div>
        </div>
    </div>

    <div class="modal-wrap modal-balance modal-balance--four">
        <div class="modal modal-balance-size">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-balance__title">
                    Оплата пройшла успішно!
                </div>
                <button class="modal-balance__btn-finish btn btn--purple-border close-modal">
                    Закрити
                </button>
            </div>
        </div>
    </div>
    @include('modals.edit-profile')

    @include('modals.edit-portfolio-img', ['sections' => $sections])
    @include('modals.edit-portfolio-video', ['sections' => $sections])

@endsection
