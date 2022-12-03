<div class="modal-wrap modal-balance modal-balance--three">
    <div class="modal modal-balance-size">
        <div class="modal__body">
            <div class="modal__close"></div>
            <div class="modal-balance__title">
                Оплата
            </div>
            <div class="price-block">
                До оплати
                <div class="price-item"><span>€</span> <span id="cost-coins">0</span></div>
            </div>
            <form  method="POST" action="{{ route('balance-replenishment') }}" class="modal-balance-form">
                @csrf
                <input type="hidden" id="payment-coins" name="coins">
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
                <button type="submit" class="modal-balance-form__btn btn btn--orange">
                    Оплатити
                </button>
            </form>
        </div>
    </div>
</div>