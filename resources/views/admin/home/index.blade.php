@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <div class="row">
        <div class="col home-cards">
            <div class="card">
                <div class="card-body">
                    <h2>{{ trans('admin.home.new_users_count') }}</h2>
                        <table class="table table-hover table-listing">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.home.per_day') }}</th>
                                <th>{{ trans('admin.home.per_month') }}</th>
                                <th>{{ trans('admin.home.total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $newUsers['day'] }}</td>
                                <td>{{ $newUsers['month'] }}</td>
                                <td>{{ $newUsers['all'] }}</td>

                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2>{{ trans('main.active_orders_count') }}</h2>
                    <table class="table table-hover table-listing">
                        <thead>
                        <tr>
                            <th>{{ trans('admin.home.per_day') }}</th>
                            <th>{{ trans('admin.home.per_month') }}</th>
                            <th>{{ trans('admin.home.total') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $activeOrders['day'] }}</td>
                            <td>{{ $activeOrders['month'] }}</td>
                            <td>{{ $activeOrders['all'] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" id="update-mobile-block" action="{{ route('update-mobile-block-show') }}">
                        @csrf
                        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('type_id'), 'has-success': fields.type_id && fields.type_id.valid }">
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                                <select class="form-control"  name="show_id" onchange="event.preventDefault(); document.getElementById('update-mobile-block').submit();">
                                    <option @if(!App\Models\ShowComponent::isMobileBlockShow()) selected @endif value="0">{{ trans('main.hide') }}</option>
                                    <option @if(App\Models\ShowComponent::isMobileBlockShow()) selected @endif value="1">{{ trans('main.show') }}</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection