@php
    $footerLink->setLocale('en');
@endphp
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('en'), 'has-success': fields.en && fields.en.valid }">
    <label for="en" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">EN</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" value="{{ $footerLink->name }}" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('en'), 'form-control-success': fields.en && fields.en.valid}" id="en" name="en" placeholder="{{ trans('admin.footer-link.columns.name') }}">
        <div v-if="errors.has('en')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('en') }}</div>
    </div>
</div>
@php
    $footerLink->setLocale('ua');
@endphp
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('ua'), 'has-success': fields.ua && fields.ua.valid }">
    <label for="ua" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">UA</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" value="{{ $footerLink->name }}" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('ua'), 'form-control-success': fields.ua && fields.ua.valid}" id="ua" name="ua" placeholder="{{ trans('admin.footer-link.columns.name') }}">
        <div v-if="errors.has('ua')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ua') }}</div>
    </div>
</div>
@php
    $footerLink->setLocale('cz');
@endphp
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cz'), 'has-success': fields.cz && fields.cz.valid }">
    <label for="cz" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">CZ</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" value="{{ $footerLink->name }}" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cz'), 'form-control-success': fields.cz && fields.cz.valid}" id="cz" name="cz" placeholder="{{ trans('admin.footer-link.columns.name') }}">
        <div v-if="errors.has('cz')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cz') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('footer_title_id'), 'has-success': fields.footer_title_id && fields.footer_title_id.valid }">
    <label for="footer_title_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task-category.columns.footer_title_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-validate="'required'"  v-model="form.footer_title_id" class="form-control" id="footer_title_id" name="footer_title_id">
            @foreach($footerTitles as $title)
                <option value="{{ $title->id }}">{{$title->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('link'), 'has-success': fields.link && fields.link.valid }">
    <label for="link" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.footer-link.columns.link') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.link" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('link'), 'form-control-success': fields.link && fields.link.valid}" id="link" name="link" placeholder="{{ trans('admin.footer-link.columns.link') }}">
        <div v-if="errors.has('link')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('link') }}</div>
    </div>
</div>


