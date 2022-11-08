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
            @auth
            @if(Auth::user()->isSpecialist())
            <button class="modal-balance__btn btn btn--purple vip-status-button">
                Віп статус (10 монет)
            </button>
            <form method="POST" action="{{ route('buy-vip-status') }}" class="buy-vip-status" style="display: none;">@csrf</form>
            @endif
            @endauth
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.vip-status-button').click(function(event){
        var form =  $('.buy-vip-status');
        event.preventDefault();
        swal({
            title: "{{ trans('main.payment_confirmation') }}",
            text: "{{ trans('main.vip-status-text') }}",
            icon: "warning",
            type: "warning",
            buttons: ["{{ trans('main.cancel') }}","{{ trans('main.yes') }}!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((confirm) => {
            if (confirm) {
                form.submit();
            }
        });
    });
</script>