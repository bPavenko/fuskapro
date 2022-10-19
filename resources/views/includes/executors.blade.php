@foreach($executors as $executor)
    <div class="person-row row-item">
        <div class="person-block">
            <div class="person-block__img">
                <img loading="lazy" src="img/person-block-img4.png" alt="img">
            </div>
            <div class="person-block__info">
                <div class="person-block__name">
                    {{ $executor->name }}
                </div>
                <div class="person-block__online">
                    {{ $executor->lastSeen() }}
                </div>
            </div>
        </div>
        <div class="star {{ 'star-' . intval($executor->getRate()) }}">
            <div class="star-item"></div>
            <div class="star-item"></div>
            <div class="star-item"></div>
            <div class="star-item"></div>
            <div class="star-item"></div>
        </div>
        <div class="specialist-info-item">
            <div class="specialist-info-item__num">
                {{ count($executor->rates) }}
            </div>
            <a href="#" class="specialist-info-item__text">
                {{ trans('main.rates_count') }}
            </a>
        </div>
        <div class="specialist-info-item">
            <div class="specialist-info-item__num">
                {{ $executor->getRate() }}
            </div>
            <div class="specialist-info-item__text">
                {{ trans('main.rate') }}
            </div>
        </div>
        <a href="{{ route('show-user', $executor->id) }}" class="person-row__btn btn btn--orange">
            Замовити
        </a>
    </div>
@endforeach