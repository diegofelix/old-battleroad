@extends ('layouts.admin_register')
@section ('register_content')

    <h3>
        {{ link_to_route(
            'admin.register.games.create',
            'Adicionar jogo',
            [$championship->id],
            ['class' => 'btn btn-info']
        ) }}
    </h3>

    <div class="well alert-success">
        <p>Agora precisamos criar os jogos que farão parte do seu campeonato.</p>
        <p>Clique em "Adicionar jogo" para adicionar um jogo, definir preço, tipo de eliminação e etc.</p>
    </div>

    <table class="table table-striped table-hover games-table">
        <thead>
            <tr>
                <th>Jogo</th>
                <th>Formato</th>
                <th>Plataforma</th>
                <th>Preço</th>
                <th>Data</th>
                <th>Remover?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->competitions as $competition)
                <tr>
                    <td>{{ HTML::image($competition->game->icon) }}</td>
                    <td>{{ $competition->format->name }}</td>
                    <td>{{ HTML::image($competition->platform->icon) }}</td>
                    <td>R$ {{ $competition->price }}</td>
                    <td>{{ $competition->start }}</td>
                    <td>
                        {{ Form::open(['route' => ['admin.register.games.destroy', $championship->id, $competition->id], 'method' => 'DELETE', 'role' => 'form']) }}
                            <button type="submit" class="btn btn-danger">
                                <i class="icon icon-times-circle"></i>
                            </button>
                        {{ Form::close() }}
                        {{--
                            link_to_route(
                                'admin.championships.games.delete',
                                'Remover',
                                [$championship->id, $competition->id],
                                ['class' => 'btn btn-danger']
                        )--}}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="form-group">
        <a href="{{ route('admin.register.confirmation', $championship->id) }}" class="btn btn-success champ-button"><i class="icon icon-arrow-right"></i> Continuar</a>
    </div>

@stop
