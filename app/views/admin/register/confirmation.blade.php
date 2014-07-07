@extends ('layouts.admin_register')

@section ('register_content')

    <dl class="dl-horizontal">
        <dt>Título</dt>
        <dd>{{ $championship->name }}</dd>
        <dt>Descrição</dt>
        <dd>{{ $championship->description }}</dd>
        <dt>Data de início</dt>
        <dd>{{ $championship->event_start->format('d/m/Y') }}</dd>

        <dt>Localização</dt>
        <dd>{{ $championship->location }}</dd>
        <dt>Entrada</dt>
        <dd>
            @if ($championship->price)
                R$ {{ $championship->price }},00
            @else
                Gratuita
            @endif
        </dd>
        <dt>Limite de Pessoas</dt>
        <dd>
            @if ($championship->limit)
                {{ $championship->limit }}
            @else
                Ilimitado
            @endif
        </dd>

        <dt>Jogos</dt>
        <dd>
            @if ($championship->competitions)
                @foreach($championship->competitions as $competition)
                    <p>{{ $competition->game->name }}</p>
                @endforeach
            @endif
        </dd>
    </dl>

    <p>
        <a href="{{ route('admin.register.publish', [$championship->id]) }}"
            class="btn btn-success btn-lg btn-block">
            Publicar
        </a>
    </p>

@endsection