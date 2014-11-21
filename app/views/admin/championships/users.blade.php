@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3><i class="fa fa-users"></i>
        Participantes
        <div id="payment-filter" class="btn-group pull-right">
            <button type="button" data-status="all" class="btn btn-sm btn-default">Todos</button>
            <button type="button" data-status="paid" class="btn btn-sm btn-default">Confirmados</button>
            <button type="button" data-status="pending" class="btn btn-sm btn-default">Pendentes</button>
        </div>
    </h3>

    <table class="table table-striped table-hover games-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->joins as $join)
                <tr class="status status-{{ $join->present()->simplifiedStatus }}">
                    <td>{{ HTML::image($join->user->present()->userImage) }}
                    {{ $join->user->name }}</td>
                    <td>{{ $join->status->name }}</td>
                    <td><a href="">Detalhes</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
@section('scripts')
    {{ HTML::script('js/admin_championship.js') }}
@stop