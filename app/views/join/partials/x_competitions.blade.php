@foreach ($championship->competitions as $competition)
    @include('join/partials/competition_players')
@endforeach