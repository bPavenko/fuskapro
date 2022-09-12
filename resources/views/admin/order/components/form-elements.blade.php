<div class="form-group row align-items-center" :class="{'has-danger': errors.has('section_id'), 'has-success': fields.section_id && fields.section_id.valid }">
    <label for="section_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.section_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.section_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('section_id'), 'form-control-success': fields.section_id && fields.section_id.valid}" id="section_id" name="section_id" placeholder="{{ trans('admin.order.columns.section_id') }}">
        <div v-if="errors.has('section_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('section_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('category_id'), 'has-success': fields.category_id && fields.category_id.valid }">
    <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.category_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.category_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('category_id'), 'form-control-success': fields.category_id && fields.category_id.valid}" id="category_id" name="category_id" placeholder="{{ trans('admin.order.columns.category_id') }}">
        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('category_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.title') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.order.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('short_description'), 'has-success': fields.short_description && fields.short_description.valid }">
    <label for="short_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.short_description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.short_description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('short_description'), 'form-control-success': fields.short_description && fields.short_description.valid}" id="short_description" name="short_description" placeholder="{{ trans('admin.order.columns.short_description') }}">
        <div v-if="errors.has('short_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('short_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('full_description'), 'has-success': fields.full_description && fields.full_description.valid }">
    <label for="full_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.full_description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.full_description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('full_description'), 'form-control-success': fields.full_description && fields.full_description.valid}" id="full_description" name="full_description" placeholder="{{ trans('admin.order.columns.full_description') }}">
        <div v-if="errors.has('full_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('full_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('execution_date'), 'has-success': fields.execution_date && fields.execution_date.valid }">
    <label for="execution_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.execution_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.execution_date" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('execution_date'), 'form-control-success': fields.execution_date && fields.execution_date.valid}" id="execution_date" name="execution_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('execution_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('execution_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('start_execution_time'), 'has-success': fields.start_execution_time && fields.start_execution_time.valid }">
    <label for="start_execution_time" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.start_execution_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.start_execution_time" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('start_execution_time'), 'form-control-success': fields.start_execution_time && fields.start_execution_time.valid}" id="start_execution_time" name="start_execution_time" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('start_execution_time')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('start_execution_time') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('end_execution_time'), 'has-success': fields.end_execution_time && fields.end_execution_time.valid }">
    <label for="end_execution_time" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.end_execution_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.end_execution_time" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('end_execution_time'), 'form-control-success': fields.end_execution_time && fields.end_execution_time.valid}" id="end_execution_time" name="end_execution_time" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('end_execution_time')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('end_execution_time') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.order.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('by_user'), 'has-success': fields.by_user && fields.by_user.valid }">
    <label for="by_user" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.by_user') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.by_user" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('by_user'), 'form-control-success': fields.by_user && fields.by_user.valid}" id="by_user" name="by_user" placeholder="{{ trans('admin.order.columns.by_user') }}">
        <div v-if="errors.has('by_user')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('by_user') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('price_negotiable'), 'has-success': fields.price_negotiable && fields.price_negotiable.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="price_negotiable" type="checkbox" v-model="form.price_negotiable" v-validate="''" data-vv-name="price_negotiable"  name="price_negotiable_fake_element">
        <label class="form-check-label" for="price_negotiable">
            {{ trans('admin.order.columns.price_negotiable') }}
        </label>
        <input type="hidden" name="price_negotiable" :value="form.price_negotiable">
        <div v-if="errors.has('price_negotiable')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price_negotiable') }}</div>
    </div>
</div>


