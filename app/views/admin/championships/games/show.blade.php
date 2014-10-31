@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3><i class="icon icon-gamepad"></i> {{ $competition->game->name }}</h3>

    <h3><i class="icon icon-users"></i>
        Participantes
        <div id="payment-filter" class="btn-group pull-right">
            <button type="button" data-status="all" class="btn btn-sm btn-default">Todos</button>
            <button type="button" data-status="paid" class="btn btn-sm btn-default">Confirmados</button>
            <button type="button" data-status="pending" class="btn btn-sm btn-default">Pendentes</button>
        </div>
    </h3>
    <hr>

    <table class="table table-striped table-hover games-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competition->items as $item)
                <tr class="status status-{{ $item->join->present()->simplifiedStatus }}">
                    <td>{{ HTML::image($item->join->user->present()->userImage) }}
                    {{ $item->join->user->name }}</td>
                    <td>{{ $item->join->status->name }}</td>
                    <td><a href="">Detalhes</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
@section('scripts')
    {{ HTML::script('js/admin_championship.js') }}
@stop