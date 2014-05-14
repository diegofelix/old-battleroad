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
    <table class="table table-striped table-hover games-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jogo</th>
                <th>Formato</th>
                <th>Plataforma</th>
                <th>Administrar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->competitions as $competition)
                <tr>
                    <td>{{ HTML::image($competition->game->icon) }}</td>
                    <td>{{ $competition->game->name }}</td>
                    <td>{{ $competition->format->name }}</td>
                    <td class="platform">{{ HTML::image($competition->platform->icon) }}</td>
                    <td>
                        {{
                            link_to_route(
                                'admin.championships.games.show',
                                'Alterar',
                                [$championship->id, $competition->id],
                                ['class' => 'btn btn-default']
                        ) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
