@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.admin-reviewer.actions.edit', ['name' => $adminReviewer->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <admin-reviewer-form
                :action="'{{ $adminReviewer->resource_url }}'"
                :data="{{ $adminReviewer->toJson() }}"
                v-cloak
                inline-template>
            
                <form action="{{ route('admin/admin-reviewers/update', ['adminReviewer' => $adminReviewer->id]) }}" enctype="multipart/form-data" class="form-horizontal form-edit" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{ $adminReviewer->id }}">
                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.admin-reviewer.actions.edit', ['name' => $adminReviewer->name]) }}
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