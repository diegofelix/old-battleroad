@foreach ($competitions as $competition)

    <li>{{ link_to('championships?game=' . $competition, $competition) }}</li>

@endforeach