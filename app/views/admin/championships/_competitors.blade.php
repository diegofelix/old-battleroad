<h3><i class="fa fa-users"></i>
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
            <th>Inscrição</th>
            <th>Nome</th>
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
                    {{ link_to_route('profile.show', $join->user->name, [$join->user->username]) }}
                </td>
                <td>
                    <a href="{{ route('admin.championships.transaction', [$join->championship_id, $join->id]) }}">
                        <i class="fa fa-money"></i> {{ $join->status->name }}
                    </a>
                </td>
                <td>
                    <a
                        href="#"
                        class="checkin-button btn btn-default @if ($join->checkin) btn-success @endif"
                        data-loading-text="Salvando.."
                        autocomplete="off"
                        data-join="{{ $join->id }}"
                    ><i class="fa fa-check"></i> Check In</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>