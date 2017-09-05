@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3><i class="fa fa-gamepad"></i> {{ $competition->game->name }}</h3>

    @include ('admin.championships.partials._competitors')
@stop
@section('scripts')
    {!! HTML::script('js/admin_championship.js') !!}
@stop