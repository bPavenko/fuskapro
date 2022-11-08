<div class="modal-wrap modal-edit-img">
    <div class="modal modal-edit">
        <div class="modal__body">
            <div class="modal__close"></div>
            <div class="modal-edit__wrapper">
                <div class="modal-edit__img">
                    <img class="modal-edit-image" id="modal-edit-image"  loading="lazy" src="" alt="img">
                </div>
                <form method="POST" action="{{ route('update-portfolio') }}" class="modal-edit-form"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="image-id" name="id">
                    <input type="hidden" id="image-type" name="type">
                    @if(!isset($user))
                    <div class="modal-edit-form__top">
                        {{ trans('main.change_photo') }}:
                        <div class="input-file btn btn--purple">
                            <input name="edit-image" type="file">
                            {{ trans('main.upload_photo') }}
                        </div>
                    </div>
                    @endif
                    @if(!isset($user))
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div id="image-section-name" class="custom-select-value">{{ trans('main.choose_section') }}</div>
                            <input id="image-section-id" name="section_id" class="custom-select-input" type="hidden" placeholder="{{ trans('main.choose_section') }}">
                        </div>
                        <div class="sections-list custom-select__list">
                            @if(!isset($user))
                                @foreach($sections as $section)
                                    <div id="{{ $section->id }}" class="custom-select-item">
                                        {{$section->name}}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="custom-select">
                        <div class="custom-select__top">
                            <div id="image-category-name" class="custom-select-value">{{ trans('main.choose_category') }}</div>
                            <input id="image-category-id" name="category_id" class="custom-select-input" type="hidden" placeholder="Оберіть категорію">
                        </div>
                        <div class="categories-list custom-select__list">
                        </div>
                    </div>
                    @else
                        <div class="input-block">
                            <input id="section-name" class="input" type="text" readonly>
                        </div>
                        <br>
                        <div class="input-block">
                            <input id="category-name" class="input" type="text" readonly>
                        </div>
                    @endif
                    <div class="textarea-block">
                        <textarea @if(isset($user)) readonly @endif id="image-description" name="description" placeholder="{{ trans('main.description') }}" class="textarea"></textarea>
                    </div>
                    @if(!isset($user))
                    <div class="modal-edit-form__bottom">
                        <button class="modal-edit-form__btn btn btn--purple-border">
                            {{ trans('main.delete') }}
                        </button>
                        <button class="modal-edit-form__btn btn btn--purple">
                            {{ trans('main.save') }}
                        </button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    @if (isset(session('active_modals')['edit-portfolio-img']))
    $.ajax({
        url: "/get-portfolio-media",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: "{{ session('active_modals')['edit-portfolio-img'] }}"
        },
        dataType: 'json',
        success: function success(data) {
            $('#image-id').val(data.media.id);
            $('#image-type').val(data.media.type);
            $('#image-category-name').html(data.media.category_name);
            $('#image-section-name').html(data.media.section_name);
            $('#image-description').val(data.media.description);
            $('#image-category-id').val(data.media.category_id);
            $('#image-section-id').val(data.media.section_id);
            $('#modal-edit-image').attr('src', data.media.path);
        }
    });
    $('.modal-edit-img').addClass('active');
    @endif
</script>