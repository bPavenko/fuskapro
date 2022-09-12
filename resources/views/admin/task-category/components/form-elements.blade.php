<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task-category.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.task-category.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('parent_id'), 'has-success': fields.parent_id && fields.parent_id.valid }">
    <label for="parent_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task-category.columns.parent_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select v-validate="'required'"  v-model="form.parent_id" class="form-control" id="parent_id" name="parent_id">
            @foreach($sections as $section)
                <option value="{{ $section->id }}">{{$section->name}}</option>
            @endforeach
            </select>
{{--        <input type="   " v-model="form.parent_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('parent_id'), 'form-control-success': fields.parent_id && fields.parent_id.valid}" id="parent_id" name="parent_id" placeholder="{{ trans('admin.task-category.columns.parent_id') }}">--}}
{{--        <div v-if="errors.has('parent_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('parent_id') }}</div>--}}
    </div>
</div>


