@extends ('layouts.default')
@section ('content')

    @include ('partials._featured_title', ['title' => $championship->name])

    <div class="container">
        <div class="row">
            <div id="description" class="col-md-8">
                {{ HTML::image($championship->image, $championship->name, ['class' => 'img-responsive']) }}
                {{ $championship->description }}
            </div>
            <div id="payments" class="col-md-4">

            </div>
        </div>
    </div>

@stop