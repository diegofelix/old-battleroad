@extends ('layouts.admin_register_2')

@section ('register_content')

    <ol id="steps">
        <li>
            <div class="step-title step-finished">
                <span class="number">1</span>
                <h2>
                    Informações
                    <small>Como vai ser?</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">2</span>
                <h2>
                    Jogos
                    <small>Quais jogos?</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">3</span>
                <h2>
                    Valores
                    <small>Quanto custará pra participar</small>
                </h2>
            </div>
            <div class="row">
                <div class="step-content col-md-12">

                    {{ Form::model($championship, ['route' => ['admin.register.storePricing', $championship->id], 'role' => 'form', 'files' => true, 'class' => 'form-horizontal']) }}
                        {{ Form::hidden('id', $championship->id) }}

                        <div class="mini-helper warning">
                            <p>Há campeonatos realizados dentro de locais onde é necessário pagar pra entrar. Se for o seu caso, você pode definir o preço no campo <strong>Entrada</strong>.</p>
                            <p>Deixando em branco significa que a entrada no local é gratuita.</p>
                        </div>

                        <fieldset>

                            <legend>Valores</legend>

                            <div class="form-group">
                                {{ Form::label('competiton', 'Entrada', ['class' => 'control-label col-md-4'])}}
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">R$</div>
                                        <input class="form-control" type="text" name="price">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            @foreach ($championship->competitions as $competition)
                                <div class="form-group">
                                    {{ Form::label('competiton', $competition->game->name, ['class' => 'col-md-4 control-label'])}}
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-addon">R$</div>
                                            <input class="form-control" type="text" name="championship[{{ $competition->id }}][]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </fieldset>

                        <div class="form-group next-step">
                            <button type="submit" class="btn btn-success pull-right champ-button"><i class="fa fa-arrow-right"></i> Continuar</button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">4</span>
                <h2>
                    Sistema de Pagamento
                    <small>Integre à sua conta Mercado Livre</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">5</span>
                <h2>
                    Confirmação
                    <small>Tudo certo?</small>
                </h2>
            </div>
        </li>
    </ol>

@endsection

@section ('scripts')
    {!! HTML::script('js/register.js') !!}
    {!! HTML::script('js/help-toggle.js') !!}
@endsection