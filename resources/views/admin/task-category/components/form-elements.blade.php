<div class="form-group row align-items-center" :class="{'has-danger': errors.has('en'), 'has-success': fields.en && fields.en.valid }">
    <label for="en" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">EN</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.en" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('en'), 'form-control-success': fields.en && fields.en.valid}" id="en" name="en" placeholder="{{ trans('admin.task-section.columns.name') }}">
        <div v-if="errors.has('en')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('en') }}</div>
    </div>
</div>
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('ua'), 'has-success': fields.ua && fields.ua.valid }">
    <label for="ua" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">UA</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.ua" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('ua'), 'form-control-success': fields.ua && fields.ua.valid}" id="ua" name="ua" placeholder="{{ trans('admin.task-section.columns.name') }}">
        <div v-if="errors.has('ua')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ua') }}</div>
    </div>
</div>
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cz'), 'has-success': fields.cz && fields.cz.valid }">
    <label for="cz" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">CZ</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cz" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cz'), 'form-control-success': fields.cz && fields.cz.valid}" id="cz" name="cz" placeholder="{{ trans('admin.task-section.columns.name') }}">
        <div v-if="errors.has('cz')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cz') }}</div>
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
    </div>
</div>


