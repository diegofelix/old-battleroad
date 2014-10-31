@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>Pedido: {{ $join->id }}</h2>
            </div>
        </div>

        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="icon icon-sign-in"></span> Dados da inscrição #{{ $join->id }}</div>
                <div class="panel-body">
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
                                <td colspan="4">{{ $join->championship->name }}</td>
                            </tr>
                            <?php $total = $join->price; ?>
                            @foreach ($join->items as $item)
                                <?php $total += $item->price; ?>
                                <tr>
                                    <td>{{ $item->competition->game->name }}</td>
                                    <td>{{ $item->competition->platform->name }}</td>
                                    <td>{{ $item->competition->format->name }}</td>
                                    <td>R$ {{ $item->present()->numericPrice }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3"><span class="pull-right">Total</span></th>
                                <th colspan="2">R$ <span id="totalprice">{{ number_format($total, 2) }}</span></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if ( ! $join->isFree())

                <div class="panel panel-default">
                    <div class="panel-heading"><span class="icon icon-credit-card"></span> Dados do Pagamento</div>
                    <div class="panel-body">
                        <h4>Status : <span class="label label-info">{{ $join->status->name }}</span></h4>
                        <p><small> {{ $join->status->description }} </small></p>
                        @if ($join->status_id == 1 & ! empty($join->token))
                            <p>
                                Se já clicou em realizar o pagamento mas não concluiu, nosso sistema de pagamentos irá te enviar um e-mail referente ao código <strong>{{$join->token}}</strong> para que o pagamento seja efetuado.
                            </p>
                        @endif
                        <hr>
                        @if (empty($join->token))
                            @include ('join.bcash')
                        @endif
                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading"><span class="icon icon-info"></span> Informações adicionais</div>
                <div class="panel-body">
                    <p>Parabéns por fazer parte! Seu pedido é o <strong>{{ $join->id }}</strong>.</p>
                    <p>O campeonato está marcado pra começar em: <strong>{{ Date('d/m/Y à\s\ H\hi', strtotime($join->championship->event_start)) }}</strong>.</p>
                    <p>Tente chegar um pouco antes pra não haver problemas e boa sorte!</p>
                </div>
            </div>
        </div><!-- championship -->
    </div>
@endsection
@section('scripts')
    {{ HTML::script('js/checkout.js') }}
@stop