@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>Pedido: {{ $join->id }}</h2>
            </div>
        </div>

        <div class="container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Plataforma</th>
                        <th>Formato</th>
                        <th>Preço (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">Entrada: {{ link_to_route('championships.show', $join->championship->name, $join->championship->id) }}</td>
                        <td>{{ $join->championship->present()->userPrice }}</td>
                    </tr>
                    <?php $total = $join->price; ?>
                    @foreach ($join->items as $item)
                        <?php $total += $item->price; ?>
                        <tr>
                            <td>{{ $item->competition->game->name }}</td>
                            <td>{{ $item->competition->platform->name }}</td>
                            <td>{{ $item->competition->format->name }}</td>
                            <td>{{ $item->competition->present()->userPrice }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3"><span class="pull-right">Total</span></th>
                        <th colspan="2">R$ <span id="totalprice">{{ $total }}</span></th>
                    </tr>
                </tbody>
            </table>

            <div class="well well-lg">
                <h4>Status do Pagamento: <span class="label label-info"> Em Análise</span></h4>
            </div>

            {{ link_to_route('payment', 'Realizar Pagamento', $join->id, ['class' => 'btn btn-lg btn-primary']) }}
        </div>

    </div><!-- championship -->

@endsection
@section('scripts')
    {{ HTML::script('js/checkout.js') }}
@stop