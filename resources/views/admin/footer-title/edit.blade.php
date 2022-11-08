@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.footer-title.actions.edit', ['name' => $footerTitle->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <footer-title-form
                :action="'{{ $footerTitle->resource_url }}'"
                :data="{{ $footerTitle->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.footer-title.actions.edit', ['name' => $footerTitle->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.footer-title.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </footer-title-form>

        </div>
    
</div>

@endsection