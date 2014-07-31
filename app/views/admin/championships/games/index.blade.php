@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3><i class="icon icon-gamepad"></i> Jogos</h3>

    <table class="table table-striped table-hover games-table">
        <thead>
            <tr>
                <th>Jogo</th>
                <th>Plataforma</th>
                <th>Participantes</th>
                <th>Data</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->competitions as $competition)
                <tr>
                    <td>{{ $competition->game->name }}</td>
                    <td>{{ HTML::image($competition->platform->icon) }}</td>
                    <td>{{ $competition->items->count() }} Participantes</td>
                    <td>{{ $competition->start }}</td>
                    <td>{{ link_to_route('admin.championships.games.show', 'Detalhes', [$championship->id, $competition->id]) }}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
@stop
