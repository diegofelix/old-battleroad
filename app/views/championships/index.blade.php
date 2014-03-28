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
            @if ( ! count($championships))
                Não temos campeonatos
            @endif
        </div>

    </div>

@endsection