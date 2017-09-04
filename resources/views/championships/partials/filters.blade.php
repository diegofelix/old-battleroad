@foreach ($competitions as $competition)
    <li class="list-group-item">
        @if (Input::get('game') == $competition)
            <a href="{{ route('championships.index') }}"><span class="fa fa-check-square-o"></span> {{ $competition }}</a>
        @else
            <a href="{{ route('championships.index') . '?game=' . $competition }}"><span class="fa fa-square-o"></span> {{ $competition }}</a>
        @endif
    </li>
@endforeach