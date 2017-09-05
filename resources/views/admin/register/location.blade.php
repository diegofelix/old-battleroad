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
                    Localização
                    <small>Onde vai ser?</small>
                </h2>
            </div>
            <div class="row">
                <div class="step-content col-md-12">
                    {{ Form::model($championship, ['route' => ['admin.register.storeLocation', $championship->id], 'role' => 'form', 'files' => true]) }}

                        {{ Form::hidden('id', $championship->id) }}

                            <div class="form-group">
                                {{ Form::label('location', 'Localização', ['class' => 'control-label']) }}
                                {{ Form::text('location', null, [
                                    'class' => 'form-control togglable-help',
                                    'placeholder' => 'Localização',
                                    'id' => 'location',
                                    'required' => 'required'
                                ]) }}
                                <span class="help-block hide">
                                    Coloque o endereço da forma que você quiser, por exemplo: Online, Shopp Itaquera...
                                </span>
                            </div>

                            <div class="form-group">
                                {{ Form::label('price', 'Preço da Entrada (em Reais): ', ['class' => 'control-label']) }}
                                @include ('admin.register._price')
                            </div>

                            <div class="form-group">
                                {{ Form::label('limit', 'Limite de pessoas: ', ['class' => 'control-label']) }}
                                {{ Form::text('limit', null, [
                                    'class' => 'form-control togglable-help',
                                    'placeholder' => 'Limite',
                                    'id' => 'limit'
                                ]) }}
                                <span class="help-block hide">
                                    Preenchendo esse campo, faremos com que o limite de visitantes e participantes não ultrapasse a capacidade do lugar.<br />
                                    Deixe em branco se não houver limite.
                                </span>
                            </div>

                            <div class="form-group next-step">
                                <button type="submit" class="btn btn-success pull-right champ-button"><i class="fa fa-arrow-right"></i> Continuar</button>
                            </div>

                    {{ Form::close() }}
                </div>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">3</span>
                <h2>
                    Jogos
                    <small>Quais jogos?</small>
                </h2>
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