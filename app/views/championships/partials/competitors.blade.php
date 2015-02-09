@if ($championship->joins->count())
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Quem vai?</div>
            <table class="table table-bordered">
                @foreach ($championship->getFeaturedCompetitors($perPage) as $join)
                    <tr>
                        <td>{{ link_to_route('profile.show', $join->user->name, [$join->user->username]) }}</td>
                    </tr>
                @endforeach
            </table>
            @if ($championship->joins->count() > $perPage)
                <div class="panel-footer">
                    {{ link_to_route('join.create', 'Veja a lista completa', $championship->id, ['class' => 'btn btn-block btn-default']) }}
                </div>
            @endif
        </div>
    </div>
@endif