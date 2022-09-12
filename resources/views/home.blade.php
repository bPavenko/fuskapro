@extends('layouts.app')

@section('content')
    <div class="profile">
        <div class="container">
            <div class="profile-top">
                <div class="person-block">
                    <div class="person-block__img">
                        <img loading="lazy" src="img/person-block-img4.png" alt="img">
                    </div>
                    <div class="person-block__info">
                        <div class="person-block__name">
                            {{Auth::user()->name . ' ' . Auth::user()->surname}}
                        </div>
                    </div>
                </div>
{{--                <button class="name-edit"></button>--}}
            </div>
            <div class="tabs-wrapper tab-link-wrapper">
                <a class="tab tab-active" href="#tab-1">
                    {{ trans('main.general_information') }}
                </a>
                <a class="tab" href="#tab-2">
                    {{ trans('main.portfolio') }}
                </a>
                <a class="tab" href="#tab-3">
                    {{ trans('main.change_password') }}
                </a>
            </div>
            <div class="tabs-wrapper tab-content-wrapper">
                <div id="tab-1" class="tabs-content tabs-content-active">
                    <div class="general-information">
                        <div class="order-box">
                            <div class="order-box-item">
                                <div class="order-box-item__icon">
                                    <img loading="lazy" src="img/order-box-item-icon4.svg" alt="img">
                                </div>
                                <div>
                                    {{ trans('main.city') }}:
                                    <span>{{Auth::user()->city}}</span>
                                </div>
                            </div>
                            <div class="order-box-item">
                                <div class="order-box-item__icon">
                                    <img loading="lazy" src="img/order-box-item-icon5.svg" alt="img">
                                </div>
                                <div>
                                    {{ trans('main.date_birth') }}:
                                    <span>02.10.1982</span>
                                </div>
                            </div>
                            <div class="order-box-item">
                                <div class="order-box-item__icon">
                                    <img loading="lazy" src="img/order-box-item-icon6.svg" alt="img">
                                </div>
                                <div>
                                    {{ trans('main.gender') }}:
                                    <span>чоловіча</span>
                                </div>
                            </div>
                        </div>
                        <h4>{{ trans('main.about_me') }}:</h4>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard
                            dummy text ever since the 1500s, when an unknown printer took a galley of type and
                            scrambled it to make a type specimen
                            book. It has survived not only five centuries, but also the leap into electronic
                            typesetting, remaining essentially
                            unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing Lorem Ipsum passages, and more
                            recently with desktop publishing software like Aldus PageMaker including versions of
                            Lorem Ipsum.
                        </p>
                        <h4>{{ trans('main.orders_categories') }}:</h4>
                        <div class="purple-block-wrap">
                            <span class="purple-block">Розробка логотипів</span>
                            <span class="purple-block">Дизайн сайтів</span>
                            <span class="purple-block">Дизайн банерів</span>
                            <span class="purple-block">Дизайн поліграфії</span>
                        </div>
                        <h4>{{ trans('main.city_orders') }}:</h4>
                        <div class="purple-block-wrap">
                            <span class="purple-block">Київ</span>
                        </div>
                        <div class="bottom-link">
                            <a href="#">{{ trans('main.payments_data') }}</a>
                            <a href="#">{{ trans('main.add_card') }}</a>
                        </div>
                        <button class="remove">{{ trans('main.delete_profile') }}</button>
                    </div>
                </div>
                <div id="tab-2" class="tabs-content ">
                    <div class="portfolio">
                        <div class="portfolio-block">
                            <img class="portfolio-block__icon" src="img/portfolio-block-icon.svg" alt="img">
                            <div class="portfolio-block__text">
                                {{ trans('main.drag_photo') }}
                            </div>
                            <div class="input-file btn btn--purple">
                                <input type="file">
                                {{ trans('main.upload_photo') }}
                            </div>
                        </div>
{{--                        <div class="portfolio-block">--}}
{{--                            <img class="portfolio-block__icon" src="img/portfolio-block-icon2.svg" alt="img">--}}
{{--                            <div class="input-block">--}}
{{--                                <input class="input" type="text">--}}
{{--                            </div>--}}
{{--                            <button class="portfolio-block__btn btn btn--purple">--}}
{{--                                {{ trans('main.upload_') }}--}}
{{--                                Додати відео--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>
                    <div class="portfolio-catalog">
                        <div class="portfolio-catalog-item portfolio-catalog-item--img">
                            <a href="#" class="portfolio-catalog-item__top">
                                <img loading="lazy" src="img/portfolio-catalog-item-img.jpg" alt="img">
                                <div class="portfolio-catalog-item__title">
                                    Логотип для подарункової
                                    компанії
                                </div>
                            </a>
                            <div class="portfolio-catalog-item__bottom">
                                <button class="portfolio-catalog-item__remove">{{ trans('main.delete') }}</button>
                                <button class="portfolio-catalog-item__edit edit-img">{{ trans('main.edit') }}</button>
                            </div>
                        </div>
                        <div class="portfolio-catalog-item portfolio-catalog-item--video">
                            <a href="#" class="portfolio-catalog-item__top">
                                <img loading="lazy" src="img/portfolio-catalog-item-img2.jpg" alt="img">
                                <div class="portfolio-catalog-item__title">
                                    Промо ролик для “Eagle Shell”
                                </div>
                            </a>
                            <div class="portfolio-catalog-item__bottom">
                                <button class="portfolio-catalog-item__remove">{{ trans('main.delete') }}</button>
                                <button class="portfolio-catalog-item__edit edit-video">{{ trans('main.edit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tabs-content ">
                    <form action="#" class="change-password">
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.password') }}</div>
                            <input class="input" type="password">
                        </div>
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.new_password') }}</div>
                            <input class="input" type="password">
                        </div>
                        <div class="input-block">
                            <div class="form-block-title">{{ trans('main.repeat_password') }}</div>
                            <input class="input" type="password">
                        </div>
                        <button class="change-password__btn btn btn--orange trigger-pasword-done">
                            {{ trans('main.save_password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-wrap modal-edit-img">
        <div class="modal modal-edit">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-edit__wrapper">
                    <div class="modal-edit__img">
                        <img loading="lazy" src="img/modal-edit-img.jpg" alt="img">
                    </div>
                    <form action="#" class="modal-edit-form">
                        <div class="modal-edit-form__top">
                            {{ trans('main.change_photo') }}:
                            <div class="input-file btn btn--purple">
                                <input type="file">
                                {{ trans('main.upload_photo') }}
                            </div>
                        </div>
                        <div class="custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">{{ trans('main.choose_section') }}</div>
                                <input class="custom-select-input" type="hidden" value="Виберіть розділ">
                            </div>
                            <div class="custom-select__list">
                                <div class="custom-select-item">
                                    Виберіть розділ
                                </div>
                                <div class="custom-select-item">
                                    Виберіть розділ2
                                </div>
                                <div class="custom-select-item">
                                    Виберіть розділ3
                                </div>
                            </div>
                        </div>
                        <div class="custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">{{ trans('main.choose_category') }}</div>
                                <input class="custom-select-input" type="hidden" value="Виберіть категорію">
                            </div>
                            <div class="custom-select__list">
                                <div class="custom-select-item">
                                    Виберіть категорію
                                </div>
                                <div class="custom-select-item">
                                    Виберіть категорію2
                                </div>
                                <div class="custom-select-item">
                                    Виберіть категорію3
                                </div>
                            </div>
                        </div>
                        <div class="textarea-block">
                            <textarea placeholder="Опис" class="textarea"></textarea>
                        </div>
                        <div class="modal-edit-form__bottom">
                            <button class="modal-edit-form__btn btn btn--purple-border">
                                {{ trans('main.delete') }}
                            </button>
                            <button class="modal-edit-form__btn btn btn--purple">
                                {{ trans('main.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-wrap modal-edit-video">
        <div class="modal modal-edit">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-edit__wrapper">
                    <div class="modal-edit__img">
                        <img loading="lazy" src="img/modal-edit-img2.jpg" alt="img">
                    </div>
                    <form action="#" class="modal-edit-form">
                        <div class="input-block">
                            <input class="input" type="text" value="https://www.youtube.com/watch?v...">
                        </div>
                        <div class="custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">Виберіть розділ</div>
                                <input class="custom-select-input" type="hidden" value="Виберіть розділ">
                            </div>
                            <div class="custom-select__list">
                                <div class="custom-select-item">
                                    Виберіть розділ
                                </div>
                                <div class="custom-select-item">
                                    Виберіть розділ2
                                </div>
                                <div class="custom-select-item">
                                    Виберіть розділ3
                                </div>
                            </div>
                        </div>
                        <div class="custom-select">
                            <div class="custom-select__top">
                                <div class="custom-select-value">Виберіть категорію</div>
                                <input class="custom-select-input" type="hidden" value="Виберіть категорію">
                            </div>
                            <div class="custom-select__list">
                                <div class="custom-select-item">
                                    Виберіть категорію
                                </div>
                                <div class="custom-select-item">
                                    Виберіть категорію2
                                </div>
                                <div class="custom-select-item">
                                    Виберіть категорію3
                                </div>
                            </div>
                        </div>
                        <div class="textarea-block">
                            <textarea placeholder="Опис" class="textarea"></textarea>
                        </div>
                        <div class="modal-edit-form__bottom">
                            <button class="modal-edit-form__btn btn btn--purple-border">
                                Видалити
                            </button>
                            <button class="modal-edit-form__btn btn btn--purple">
                                Зберегти
                            </button>
                        </div>
                    </form>
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
    <div class="modal-wrap modal-balance modal-balance--one">
        <div class="modal modal-balance-size">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-balance__title">
                    {{ trans('main.balance_replenishment') }}
                </div>
                <div class="modal-balance__subtitle">
                    Коротка інформація як користувач сайту може використати придбані монети
                </div>
                <div class="now-available">
                    Зараз в наявності:
                    <div class="now-available__wrap">
                        <img src="img/coins-orange.svg" alt="img">
                        0 монет
                    </div>
                </div>
                <button class="modal-balance__btn btn btn--purple trigger-next1">
                    Поповнити баланс
                </button>
            </div>
        </div>
    </div>

    <div class="modal-wrap modal-balance modal-balance--two">
        <div class="modal modal-balance-size">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-balance__title">
                    Поповнення балансу
                </div>
                <div class="modal-balance__subtitle">
                    Оберіть кількість <br>
                    монет, яку ви хочете придбати
                </div>
                <div class="coins-radio">
                    <label class="radio-block">
                        <input type="radio" name="coins">
                        <img src="img/coins-orange.svg" alt="img">
                        5 монет
                    </label>
                    <label class="radio-block">
                        <input type="radio" name="coins">
                        <img src="img/coins-orange.svg" alt="img">
                        10 монет
                    </label>
                    <label class="radio-block">
                        <input type="radio" name="coins">
                        <img src="img/coins-orange.svg" alt="img">
                        20 монет
                    </label>
                    <label class="radio-block">
                        <input type="radio" name="coins">
                        <img src="img/coins-orange.svg" alt="img">
                        50 монет
                    </label>
                </div>
                <div class="price-block">
                    До оплати
                    <div class="price-item"><span>€</span> 10</div>
                </div>
                <button class="modal-balance__btn btn btn--orange trigger-next2">
                    Придбати 10 монет
                </button>
            </div>
        </div>
    </div>

    <div class="modal-wrap modal-balance modal-balance--three">
        <div class="modal modal-balance-size">
            <div class="modal__body">
                <div class="modal__close"></div>
                <div class="modal-balance__title">
                    Оплата
                </div>
                <div class="price-block">
                    До оплати
                    <div class="price-item"><span>€</span> 10</div>
                </div>
                <form action="#" class="modal-balance-form">
                    <div class="modal-balance-form__wrap">
                        <div class="input-block input-block--card">
                            <input class="input" type="text" placeholder="Card Number">
                        </div>
                        <div class="input-block input-block--month">
                            <input class="input" type="text" placeholder="MM/YY">
                        </div>
                        <div class="input-block input-block--cvv">
                            <input class="input" type="password" placeholder="CVV">
                        </div>
                    </div>
                    <button class="modal-balance-form__btn btn btn--orange trigger-next3">
                        Оплатити
                    </button>
                </form>
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
@endsection
