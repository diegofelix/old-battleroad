<td>
    <input
        data-target="#modal-{{$competition->id}}"
        class="input-competition"
        type="checkbox"
        name="competitions[]"
        value="{{ $competition->id }}"
        data-price="{{ $competition->price }}"
    /> {{ $competition->game->name }}
</td>
<td>{{ $competition->platform->name }}</td>
<td>{{ $competition->format->name }}</td>
<td>{{ $competition->present()->userPrice }}</td>
<td>{{ $competition->present()->slotsRemaining }}</td>
<td>
    <button
        id="edit-nicks-{{$competition->id}}"
        type="button"
        class="btn btn-info btn-xs hide"
        data-toggle="modal"
        data-target="#modal-{{$competition->id}}"
    >
        Editar Nicks
    </button>
</td>