@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3><i class="icon icon-gamepad"></i> {{ $competition->game->name }}</h3>

    <h3><small>Participantes:</small></h3>
    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competition->items as $item)
                <tr>
                    <td>{{ $item->join->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop