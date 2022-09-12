@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.task-section.actions.edit', ['name' => $taskSection->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <task-section-form
                :action="'{{ $taskSection->resource_url }}'"
                :data="{{ $taskSection->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.task-section.actions.edit', ['name' => $taskSection->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.task-section.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </task-section-form>

        </div>
    
</div>

@endsection