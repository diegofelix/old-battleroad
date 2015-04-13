{{ Form::open(['route' => ['checkin', $join->id], 'class' => 'checkin-form']) }}

    <button type="submit" class="checkin-button btn @if ($join->checkin) btn-success @else btn-default @endif" data-loading-text="Salvando.." autocomplete="off">
        <i class="fa fa-check"></i> Check In
    </button>

{{ Form::close() }}
