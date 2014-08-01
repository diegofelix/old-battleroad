@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3><i class="icon icon-users"></i> Participantes</h3>

    <table class="table table-striped table-hover games-table">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->joins as $join)
                <tr>
                    <td>{{ $join->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
