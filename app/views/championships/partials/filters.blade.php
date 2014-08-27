@foreach ($competitions as $competition)
    <li class="list-group-item">
        @if (Input::get('game') == $competition)
            <a href="{{ route('championships.index') }}"><span class="icon icon-times"></span> {{ $competition }}</a>
        @else
            {{ link_to('championships?game=' . $competition, $competition) }}
        @endif
    </li>
@endforeach