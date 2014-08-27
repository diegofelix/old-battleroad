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
                        <td>{{ $join->price }}</td>
                    </tr>
                    <?php $total = $join->price; ?>
                    @foreach ($join->items as $item)
                        <?php $total += $item->price; ?>
                        <tr>
                            <td>{{ $item->competition->game->name }}</td>
                            <td>{{ $item->competition->platform->name }}</td>
                            <td>{{ $item->competition->format->name }}</td>
                            <td>{{ $item->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3"><span class="pull-right">Total</span></th>
                        <th colspan="2">R$ <span id="totalprice">{{ $total }}</span></th>
                    </tr>
                </tbody>
            </table>

            @if ( ! $join->isFree())
                <div class="well well-lg">
                    <h4>
                        Status do Pagamento: <span class="label label-info">{{ $join->status->name }}</span>
                        @if ( $join->status_id != 2) {{-- 2 = Initiated --}}
                            <br><small>
                                {{ $join->status->description }}
                            </small>
                        @endif
                    </h4>
                </div>

                {{ link_to_route('payment', 'Realizar Pagamento', $join->id, ['class' => 'btn btn-lg btn-primary']) }}
            @endif

            <hr>

            <h3>Informações Adicionais</h3>

            <p>Parabéns por fazer parte! Seu pedido é o <strong>{{ $join->id }}</strong>.</p>
            <p>O campeonato está marcado pra começar em: <strong>{{ Date('d/m/Y à\s\ H\hi', strtotime($join->championship->event_start)) }}</strong>.</p>
            <p>Tente chegar um pouco antes pra não haver problemas e boa sorte!</p>
        </div>

    </div><!-- championship -->

@endsection
@section('scripts')
    {{ HTML::script('js/checkout.js') }}
@stop