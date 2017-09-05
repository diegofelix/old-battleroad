@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                {!! HTML::image($championship->image) !!}
            </div>
        </div>

        {{ Form::open(['route' => 'join.register', 'id' => 'checkout-form']) }}

            {{ Form::hidden('id', $championship->id) }}

            <div class="container main-container">
                <div class="panel panel-default">
                    <div class="panel-heading">Inscrição</div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Plataforma</th>
                                    <th>Formato</th>
                                    <th>Preço (R$)</th>
                                    <th>Vagas disponíveis</th>
                                    <th><i class="fa fa-cog"></i> Nick / Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($championship->competitions as $competition)
                                    <?php $total = $championship->price; ?>
                                    @if ($competition->limit > 0)
                                        <?php
                                            if ( ! empty($competitions) && in_array($competition->id, $competitions))
                                            {
                                                $total += $competition->price;
                                            }
                                        ?>
                                        <tr>
                                            @if ($competition->present()->isSingleRegistration())
                                                @include ('join.partials.single_competition')
                                            @else
                                                @include ('join.partials.team_competition')
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th colspan="3"><span class="pull-right">Total</span></th>
                                    <th colspan="3">R$ <span id="totalprice">{{ number_format($total, 2) }}</span></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <button type="submit" class="btn btn-lg btn-success">Ir para Pagamento</button>

            </div>
        @include ('join/partials/players')
        {{ Form::close() }}

    </div><!-- championship -->


@endsection
@section('scripts')
    {!! HTML::script('js/checkout.js') !!}
@stop