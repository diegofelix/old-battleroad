@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                {{ HTML::image($championship->image) }}
            </div>
        </div>
    </div><!-- championship -->

@endsection