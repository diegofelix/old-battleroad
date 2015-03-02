@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Inscrição: <strong>{{ $join->id }}</strong>
                    <small class="pull-right text-right">
                        <span class="label label-info">{{ $join->status->name }}</span>
                        <p><small> {{ $join->status->description }} </small></p>
                    </small>
                </h2>
            </div>
        </div>

        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-sign-in"></span> Dados da inscrição #{{ $join->id }}</div>
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


            @if ($join->coupon)
                <div class="alert alert-info">
                    <h4>CUPOM UTILIZADO: <strong>{{ $join->coupon->code }}</strong> no valor de: <strong>R$ {{ number_format($join->coupon->price, 2) }}</strong></h4>
                </div>
            @else
                @if ( ! $join->isPaid())
                    @include('join.coupon')
                @endif
            @endif

            @if ( ! $join->isFree())
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-credit-card"></span> Dados do Pagamento</div>
                    <div class="panel-body">
                        @if ($join->status_id == 1 & ! empty($join->token))
                            @if ($join->inGracePeriod())
                                <div class="alert alert-danger">
                                    <h4><span class="fa fa-exclamation fa-lg"></span> <strong> Atenção:</strong></h4>
                                    <p>O campeonato é daqui 2 dias, isso significa que pagamentos como boleto e depósito podem não ser confirmados até a o dia do campeonato. Escolha opções de pagamento mais rápidas, como cartão de crédito ou débito online.</p>
                                </div>
                            @endif
                            <div class="alert alert-warning">
                                Se já clicou em realizar o pagamento mas não concluiu, nosso sistema de pagamentos irá te enviar um e-mail referente ao código <strong>{{$join->token}}</strong> para que o pagamento seja efetuado.
                            </div>
                            <hr>
                        @endif

                        @if ( ! $join->isPaid())
                            @if ( ! $join->championship->finished)
                                @include ('join.bcash')
                            @else
                                <p>O campeonato já está em andamento, por isso, você não poderá mais realizar o pagamento.</p>
                            @endif
                        @else
                            <p>Você já está inscrito no campeonato!</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($join->isPaid())
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-info"></span> Informações adicionais</div>
                    <div class="panel-body">
                        <p>Parabéns por fazer parte! Seu pedido é o <strong>{{ $join->id }}</strong>.</p>
                        <p>O campeonato está marcado pra começar em: <strong>{{ Date('d/m/Y à\s\ H\hi', strtotime($join->championship->event_start)) }}</strong>.</p>
                        <p>Tente chegar um pouco antes pra não haver problemas e boa sorte!</p>
                    </div>
                </div>
            @endif
        </div><!-- championship -->
    </div>
@endsection
@section('scripts')
    {{ HTML::script('js/checkout.js') }}
@stop