@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Campeonatos
                    {{ link_to_route('championships.create', 'Criar um Campeonato', null, ['class' => 'btn btn-default create-button pull-right']) }}
                </h2>
            </div>
        </div>

        <div class="container">
            @if (count($championships))
                @foreach ($championships as $champ)

                    <h2>{{ HTML::image($champ->image) }}</h2>
                    <p>{{ $champ->description }}</p>

                @endforeach
            @endif
        </div><!-- container -->
    </div><!-- championship -->

@endsection