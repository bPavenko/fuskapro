
<div class="general-information">
    <div class="order-box">
        <div class="order-box-item">
            <div class="order-box-item__icon">
                <img loading="lazy" src="img/order-box-item-icon4.svg" alt="img">
            </div>
            <div>
                {{ trans('main.city') }}:
                <span>{{Auth::user()->cityName}}</span>
            </div>
        </div>
        <div class="order-box-item">
            <div class="order-box-item__icon">
                <img loading="lazy" src="img/order-box-item-icon6.svg" alt="img">
            </div>
            <div>
                {{ trans('main.role') }}:
                <span> @if(Auth::user()->type_id == 1) {{ trans("main.user") }} @else {{ trans("main.specialist") }} @endif</span>
            </div>
        </div>
    </div>
    <h4>{{ trans('main.about_me') }}:</h4>
    <p>
        {{ Auth::user()->about_me }}
    </p>
    <h4>{{ trans('main.orders_categories') }}:</h4>
    <div class="purple-block-wrap">
        @foreach(Auth::user()->categories as $category)
            <span class="purple-block">{{ $category->name }}</span>
        @endforeach
    </div>
    @if(Auth::user()->delete_request)
        <button class="remove" onclick="event.preventDefault(); document.getElementById('recover-delete-user').submit();">{{ trans('main.recover-delete-user') }}</button>
        <form id="recover-delete-user" action="{{ route('recover-delete-user') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <button class="remove show-alert-delete-box">{{ trans('main.delete_profile') }}</button>
        <form method="POST" action="{{ route('delete-user') }}" class="delete-user-form" style="display: none;">@csrf</form>
    @endif


</div>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $('.delete-user-form');
        event.preventDefault();
        swal({
            title: "{{ trans('main.delete_user_confirmation') }}",
            text: "{{ trans('main.delete_user_text') }}",
            icon: "warning",
            type: "warning",
            buttons: ["{{ trans('main.cancel') }}","{{ trans('main.yes') }}!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((willDeleteUser) => {
            if (willDeleteUser) {
                form.submit();
            }
        });
    });
</script>