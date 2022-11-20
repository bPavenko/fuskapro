<div class="hidden form-group row align-items-center" :class="{'has-danger': errors.has('service'), 'has-success': fields.service && fields.service.valid }">
    <label for="service" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.price.columns.service') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.service" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('service'), 'form-control-success': fields.service && fields.service.valid}" id="service" name="service" placeholder="{{ trans('admin.price.columns.service') }}">
        <div v-if="errors.has('service')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('service') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost'), 'has-success': fields.cost && fields.cost.valid }">
    <label for="cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.price.columns.cost') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost'), 'form-control-success': fields.cost && fields.cost.valid}" id="cost" name="cost" placeholder="{{ trans('admin.price.columns.cost') }}">
        <div v-if="errors.has('cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost') }}</div>
    </div>
</div>


