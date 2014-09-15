@foreach ($competitions as $competition)
    <li class="list-group-item">
        @if (Input::get('game') == $competition)
            <a href="{{ route('championships.index') }}"><span class="icon icon-check-square-o"></span> {{ $competition }}</a>
        @else
            <a href="{{ route('championships.index') . '?game=' . $competition }}"><span class="icon icon-square-o"></span> {{ $competition }}</a>
        @endif
    </li>
@endforeach