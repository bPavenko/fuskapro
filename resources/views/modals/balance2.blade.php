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
            <div class="input-block coins-input">
                <img src="{{ asset('img/coins-orange.svg') }}" alt="img">
                <input class="input count-coins" id="count-coins" type="text" name="coins">
            </div>
{{--            <div class="price-block">--}}
{{--                До оплати--}}
{{--                <div class="price-item"><span>€</span> 10</div>--}}
{{--            </div>--}}
            <button class="modal-balance__btn btn btn--orange trigger-next2">
                Придбати
            </button>
        </div>
    </div>
</div>