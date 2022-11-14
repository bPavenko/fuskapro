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
        </div>
    </div>
@endsection