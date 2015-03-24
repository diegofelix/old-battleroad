{{ Form::open(['route' => ['checkin', $join->id], 'class' => 'checkin-form']) }}

    <button type="submit" class="checkin-button btn btn-default @if ($join->checkin) bnt-success @endif" data-loading-text="Salvando.." autocomplete="off">
        <i class="fa fa-check"></i> Check In
    </button>

{{ Form::close() }}