<h3><i class="fa fa-users"></i>
    Participantes
    <div id="payment-filter" class="btn-group pull-right">
        <button type="button" data-status="all" class="btn btn-sm btn-default">Todos</button>
        <button type="button" data-status="paid" class="btn btn-sm btn-default">Confirmados</button>
        <button type="button" data-status="pending" class="btn btn-sm btn-default">Pendentes</button>
    </div>
</h3>
<hr>

<div class="panel panel-default">
    <table class="table table-striped table-hover games-table">
    <thead>
        <tr>
            <th>Inscrição</th>
            <th>Nome/Nick</th>
            <th>Status</th>
            <th>Check In</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($joins as $join)
            <tr class="status status-{{ $join->present()->simplifiedStatus }}">
                <td># {{ $join->id }}</td>
                <td>
                    {{ HTML::image($join->user->present()->userImage) }}
                    {{ link_to_route('profile.show', $join->present()->competitorName, [$join->user->username]) }}
                </td>
                <td>
                    <a href="{{ route('admin.championships.transaction', [$join->championship_id, $join->id]) }}">
                        <i class="fa fa-money"></i> {{ $join->status->name }}
                    </a>
                </td>
                <td>
                    @include('admin.championships.partials._checkin_form')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>