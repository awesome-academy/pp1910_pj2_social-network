<div class="suggestion-box full-width">
    <div class="suggestions-list list-follows-suggestion">
        @if($suggestUsers->count() > 0)
            @foreach($suggestUsers as $user)
                @include('block.widgets.one_suggest_user')
            @endforeach
        @else
        @endif
    </div>
</div>