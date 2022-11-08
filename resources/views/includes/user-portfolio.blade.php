<div class="user-portfolio-catalog">
    @foreach($user->portfolio as $item)
        @if($item->type == 'image')
            <div class="portfolio-catalog-item portfolio-catalog-item--img">
                <a href="#" class="portfolio-catalog-item__top">
                    <img loading="lazy" src="{{ asset('storage/images/'. $item->path) }} " alt="img">
                    <div class="portfolio-catalog-item__title">
                        {{ $item->description }}
                    </div>
                </a>
                <div class="portfolio-catalog-item__bottom">
                    <button media-id="{{ $item->id }}" class="portfolio-catalog-item__edit edit-img">{{ trans('main.show') }}</button>
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
                    <button media-id="{{ $item->id }}" class="portfolio-catalog-item__edit edit-video">{{ trans('main.show') }}</button>
                </div>
            </div>
        @endif
    @endforeach
</div>
<style>


</style>