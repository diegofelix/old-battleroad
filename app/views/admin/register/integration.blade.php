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
            <div class="step-title step-finished">
                <span class="number">2</span>
                <h2>
                    Localização
                    <small>Onde vai ser?</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title step-finished">
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
            <div class="row">
                <div class="step-content col-md-12">
                    <div class="mini-helper warning">
                        <p>Clique abaixo para autorizar a Battleroad a direcionar os pagamento dos inscritos diretamente pra sua conta.</p>
                        <p>O Sistema que a Battleroad utiliza como pagamento é o Mercado Livre, o maior motivo é justamente a facilidade de integração entre o recebedor, o pagador e nós, os intermediários.</p>
                    </div>

                    <p>{{ link_to_route('admin.register.login', 'Integrar com Mercado Livre', [$championship->id, ], ['class' => 'btn btn-info']) }}</p>

                    <div class="next-step">
                        <a href="{{ route('admin.register.confirmation', $championship->id) }}" class="btn btn-success pull-right champ-button"><i class="icon icon-arrow-right"></i> Continuar</a>
                    </div>
                </div>
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
    {{ HTML::script('js/register.js') }}
    {{ HTML::script('js/help-toggle.js') }}
@endsection