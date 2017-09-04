@if ($user->achievements->count())
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-trophy fa-lg"></i> Conquistas
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Posição</th>
                    <th>Jogo</th>
                    <th>Campeonato</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->achievements as $achievement)
                    <tr>
                        <td>{{ $achievement->position }}º Lugar</td>
                        <td>{{ $achievement->competition->game->name }}</td>
                        <td>{{ $achievement->championship->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif