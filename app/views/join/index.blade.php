@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                {{ HTML::image($championship->image) }}
            </div>
        </div>

        {{ Form::open(['route' => 'join.register']) }}

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
                                            <td><input class="input-competition" type="checkbox" name="competitions[]" value="{{ $competition->id }}" data-price="{{ $competition->price }}"/> {{ $competition->game->name }}</td>
                                            <td>{{ $competition->platform->name }}</td>
                                            <td>{{ $competition->format->name }}</td>
                                            <td>{{ $competition->present()->userPrice }}</td>
                                            <td>{{ $competition->present()->slotsRemaining }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th colspan="3"><span class="pull-right">Total</span></th>
                                    <th colspan="2">R$ <span id="totalprice">{{ number_format($total, 2) }}</span></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Nick para o campeonato</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::text('nick', Auth::user()->username, ['class' => 'form-control input-lg']) }}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Esse nome será exibido nas chaves do campeonato.<br>
                        Se for um campeonato Online, coloque a gamertag da plataforma ( PSN/Live e etc )
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-success">Ir para Pagamento</button>

            </div>
        {{ Form::close() }}

    </div><!-- championship -->

@endsection
@section('scripts')
    {{ HTML::script('js/checkout.js') }}
@stop