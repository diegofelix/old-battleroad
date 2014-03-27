@extends ('layouts.default')

@section ('content')

    <div class="featured-title championship">
        <div class="container">
            <h2>
                Campeonatos
                <a class="btn btn-default btn-lg pull-right">Criar um Campeonato</a>
            </h2>
        </div>
    </div>

    @if ( ! $championships)
        Ainda não tem nenhum campeonato =(
    @endif

@endsection