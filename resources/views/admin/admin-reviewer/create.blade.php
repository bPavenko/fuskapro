@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.admin-reviewer.actions.create'))

@section('body')

    <div class="container-xl">

                <div class="card">

        <admin-reviewer-form
            :action="'{{ url('admin/admin-reviewers') }}'"
            v-cloak
            inline-template>

            <form action="{{ route('admin/admin-reviewers/store') }}" enctype="multipart/form-data" class="form-horizontal form-create" method="post" novalidate>
                @csrf
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.admin-reviewer.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.admin-reviewer.components.form-elements')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>

            </form>

        </admin-reviewer-form>

        </div>

        </div>

    
@endsection