@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.task-category.actions.edit', ['name' => $taskCategory->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <task-category-form
                :action="'{{ $taskCategory->resource_url }}'"
                :data="{{ $taskCategory->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.task-category.actions.edit', ['name' => $taskCategory->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.task-category.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </task-category-form>

        </div>
    
</div>

@endsection