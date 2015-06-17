<td>
    <input
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
<td>{{
    Form::text("nicks[{$competition->id}][]", Auth::user()->username, [
        'class' => 'form-control hide',
        'id' => 'edit-nicks-'.$competition->id
    ]) }}</td>