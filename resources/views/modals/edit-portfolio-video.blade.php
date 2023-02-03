<div class="modal-wrap modal-edit-video">
    <div class="modal modal-edit">
        <div class="modal__body">
            <div class="modal__close"></div>
            <div class="modal-edit__wrapper">
                <div class="modal-edit__img">
                    <iframe id="video-path" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
                </div>
                <form method="POST" action="{{ route('update-portfolio') }}" class="modal-edit-form"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="video-id" name="id">
                    <input type="hidden" id="video-type" name="type">
                    <div class="input-block">
                        <input id="video-link" class="input" type="text" value="">
                    </div>
                    @if(!isset($user))
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div id="video-section-name" class="custom-select-value">{{ trans('main.choose_section') }}</div>
                            <input id="video-section-id" name="section_id" class="custom-select-input" type="hidden" placeholder="{{ trans('main.choose_section') }}">
                        </div>
                        <div class="sections-list custom-select__list">
                            @foreach($sections as $section)
                                <div id="{{ $section->id }}" class="custom-select-item">
                                    {{$section->name}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div id="video-category-name" class="custom-select-value">{{ trans('main.choose_category') }}</div>
                            <input id="video-category-id" name="category_id" class="custom-select-input" type="hidden" placeholder="Оберіть категорію">
                        </div>
                        <div class="categories-list custom-select__list">
                        </div>
                    </div>
                    @else
                        <br>
                        <div class="input-block">
                            <input id="video-show-section-name" class="input" type="text" readonly>
                        </div>
                        <br>
                        <div class="input-block">
                            <input id="video-show-category-name" class="input" type="text" readonly>
                        </div>
                    @endif
                    <div class="textarea-block">
                        <textarea @if(isset($user)) readonly @endif id="video-description" name="description" class="textarea">123</textarea>
                    </div>
                    <div class="modal-edit-form__bottom">
                        <button class="modal-edit-form__btn btn btn--purple-border">
                            {{ trans('main.delete') }}
                        </button>
                        <button class="modal-edit-form__btn btn btn--purple">
                            {{ trans('main.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>