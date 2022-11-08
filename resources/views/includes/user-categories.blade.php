<div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">
    <div class="panel panel-warning">
        <form action="{{ route('save-user-categories') }}" method="POST">
            @csrf
            @foreach($sections as $key => $section)
                <h3 class="panel-title"><a class="section-header" data-bs-toggle="collapse" href="{{ '#section-' . $section->id }}"  role="button">{{ $section->name }}<span class="section-collapse"></span></a></h3>
                <div class="panel-collapse collapse in" id="{{ 'section-' . $section->id }}" role="tabpanel">
                    @if(count($section->categories))
                        <div class="card">
                            <div class="card-body">
                                @foreach($section->categories as $category)
                                    <label class="checkbox-block">
                                        <input value="{{ $category->id }}" name="category[]" type="checkbox" @if(in_array($category->id, Auth::user()->getCategoriesIds())) checked @endif>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
            @endforeach
            <button type="submit" class="search-filter-row__btn btn btn--orange m-auto">
                {{ trans('main.save') }}
            </button>
        </form>
    </div>
</div>