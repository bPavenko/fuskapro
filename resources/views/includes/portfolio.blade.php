<div class="portfolio">
    <form method="POST" action="{{ route('add-portfolio-image') }}"  enctype="multipart/form-data">
        @csrf
        <div class="portfolio-block">
            <img class="portfolio-block__icon" src="img/portfolio-block-icon.svg" alt="img">
            <div class="portfolio-block__text">
                {{ trans('main.drag_photo') }}
            </div>
            <div class="input-file btn btn--purple">
                <input class="porftolio-file" name="image" type="file">
                {{ trans('main.upload_photo') }}
            </div>
            <button type="submit" class="save-portfolio__btn btn btn--purple">
                {{ trans('main.save') }}
            </button>
        </div>
    </form>
    <br>
    <form method="POST" action="{{ route('add-portfolio-video') }}">
        @csrf
        <div class="portfolio-block">
            <img class="portfolio-block__icon" src="img/portfolio-block-icon2.svg" alt="img">
            <div class="input-block">
                <input required name="path" class="input" type="text">
            </div>
            <button class="portfolio-block__btn btn btn--purple">
                {{ trans('main.upload_video') }}
            </button>
        </div>
    </form>

</div>
<div class="portfolio-catalog">
    @foreach(Auth::user()->portfolio as $item)
        @if($item->type == 'image')
            <div class="portfolio-catalog-item portfolio-catalog-item--img">
                <a href="#" class="portfolio-catalog-item__top">
                    <img loading="lazy" src="{{ asset('storage/images/'. $item->path) }} " alt="img">
                    <div class="portfolio-catalog-item__title">
                        {{ $item->description }}
                    </div>
                </a>
                <div class="portfolio-catalog-item__bottom">
                    <button media-id="{{ $item->id }}" class="portfolio-catalog-item__remove">{{ trans('main.delete') }}</button>
                    <button media-id="{{ $item->id }}" class="portfolio-catalog-item__edit edit-img">{{ trans('main.edit') }}</button>
                </div>
            </div>
        @else
            <div class="portfolio-catalog-item portfolio-catalog-item--video">
                <a href="#" class="portfolio-catalog-item__top">
                    <img loading="lazy" src="{{ $item->thumbnail }}" alt="img">
                    <div class="portfolio-catalog-item__title">
                        {{ $item->description }}
                    </div>
                </a>
                <div class="portfolio-catalog-item__bottom">
                    <button media-id="{{ $item->id }}" class="portfolio-catalog-item__remove">{{ trans('main.delete') }}</button>
                    <button media-id="{{ $item->id }}" class="portfolio-catalog-item__edit edit-video">{{ trans('main.edit') }}</button>
                </div>
            </div>
        @endif
    @endforeach
        <form method="POST" action="{{ route('delete-media') }}" class="delete-media-form" style="display: none;">
            @csrf
            <input type="hidden" name="media_id" id="delete-media-id">
        </form>
</div>
<script type="text/javascript">
    $('.portfolio-catalog-item__remove').click(function(event){
        $('#delete-media-id').val($(this).attr('media-id'))
        var form =  $('.delete-media-form');
        event.preventDefault();
        swal({
            title: "{{ trans('main.delete_confirmation') }}",
            text: "{{ trans('main.delete_media_text') }}",
            icon: "warning",
            type: "warning",
            buttons: ["{{ trans('main.cancel') }}","{{ trans('main.yes') }}!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
{{--<div class="portfolio">--}}
{{--    <div class="portfolio-block">--}}
{{--        <img class="portfolio-block__icon" src="img/portfolio-block-icon.svg" alt="img">--}}
{{--        <div class="portfolio-block__text">--}}
{{--            Перетягніть фото або--}}
{{--        </div>--}}
{{--        <div class="input-file btn btn--purple">--}}
{{--            <input type="file">--}}
{{--            Завантажити фото--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="portfolio-block">--}}
{{--        <img class="portfolio-block__icon" src="img/portfolio-block-icon2.svg" alt="img">--}}
{{--        <div class="input-block">--}}
{{--            <input class="input" type="text">--}}
{{--        </div>--}}
{{--        <button class="portfolio-block__btn btn btn--purple">--}}
{{--            Добавити відео--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="portfolio-catalog">--}}
{{--    <div class="portfolio-catalog-item portfolio-catalog-item--img">--}}
{{--        <a href="#" class="portfolio-catalog-item__top">--}}
{{--            <img loading="lazy" src="img/portfolio-catalog-item-img.jpg" alt="img">--}}
{{--            <div class="portfolio-catalog-item__title">--}}
{{--                Логотип для подарункової--}}
{{--                компанії--}}
{{--            </div>--}}
{{--        </a>--}}
{{--        <div class="portfolio-catalog-item__bottom">--}}
{{--            <button class="portfolio-catalog-item__remove">Видалити</button>--}}
{{--            <button class="portfolio-catalog-item__edit edit-img">Редагувати</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="portfolio-catalog-item portfolio-catalog-item--video">--}}
{{--        <a href="#" class="portfolio-catalog-item__top">--}}
{{--            <img loading="lazy" src="img/portfolio-catalog-item-img2.jpg" alt="img">--}}
{{--            <div class="portfolio-catalog-item__title">--}}
{{--                Промо ролик для “Eagle Shell”--}}
{{--            </div>--}}
{{--        </a>--}}
{{--        <div class="portfolio-catalog-item__bottom">--}}
{{--            <button class="portfolio-catalog-item__remove">Видалити</button>--}}
{{--            <button class="portfolio-catalog-item__edit edit-video">Редагувати</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
