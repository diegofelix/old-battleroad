@if ($championship->competitions->count() > 3)
    @include ('join/partials/x_competitions');
@else
    <?php $size = 12 / $championship->competitions->count(); ?>
    <div class="row">
        @foreach ($championship->competitions as $competition)
            <div class="panel-players" id="competition-{{ $competition->id }}">
                @include('join/partials/competition_players')
            </div>
        @endforeach
    </div>
@endif