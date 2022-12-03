<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.admin-reviewer.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.admin-reviewer.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('profession'), 'has-success': fields.profession && fields.profession.valid }">
    <label for="profession" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.admin-reviewer.columns.profession') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.profession" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('profession'), 'form-control-success': fields.profession && fields.profession.valid}" id="profession" name="profession" placeholder="{{ trans('admin.admin-reviewer.columns.profession') }}">
        <div v-if="errors.has('profession')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('profession') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('review'), 'has-success': fields.review && fields.review.valid }">
    <label for="review" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.admin-reviewer.columns.review') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.review" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('review'), 'form-control-success': fields.review && fields.review.valid}" id="review" name="review" placeholder="{{ trans('admin.admin-reviewer.columns.review') }}">
        <div v-if="errors.has('review')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('review') }}</div>
    </div>
</div>

<div class=" row align-items-center" :class="{'has-danger': errors.has('avatar'), 'has-success': fields.avatar && fields.avatar.valid }">
    <label for="avatar" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.admin-reviewer.columns.avatar') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="file" v-validate="'required'" class="" :class="{'form-control-danger': errors.has('avatar'), 'form-control-success': fields.avatar && fields.avatar.valid}" id="avatar" name="avatar">
        <div v-if="errors.has('avatar')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('avatar') }}</div>
    </div>
</div>



