@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="icon icon-gamepad"></i> Jogos
        {{ link_to_route(
            'admin.championships.games.create',
            'Adicionar jogo',
            [$championship->id],
            ['class' => 'btn btn-info btn-lg pull-right']
        ) }}
    </h3>

    @if (Session::has('show-tutorial'))
        <div class="well alert-success">
            <h4>Certo. Seu campeonato está criado!</h4>
            <p>Agora precisamos criar os jogos que farão parte do seu campeonato.</p>
            <p>Clique em "Adicionar jogo" para adicionar um jogo, definir preço, tipo de eliminação e etc.</p>
        </div>
    @endif

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
                        {{ Form::open(['route' => ['admin.championships.games.destroy', $championship->id, $competition->id], 'method' => 'DELETE', 'role' => 'form']) }}
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
@stop
