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
                    Jogos
                    <small>Quais jogos?</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">3</span>
                <h2>
                    Sistema de Pagamento
                    <small>Integre à sua conta ao Bcash</small>
                </h2>
            </div>
            <div class="row">
                <div class="step-content col-md-12">
                    <div class="mini-helper warning">
                        <h5>Conta BCash</h5>
                        <p>
                            Bcash é o sistema de pagamentos escolhido pela Battleroad. Além de ser uma empresa do grupo Buscapé e de confiança, o Bcash nos possibilita que o pagamento das inscrições do seu campeonato vá diretamente para sua conta.<br>
                            Dessa forma, o dinheiro não precisa passar pela Battleroad e você terá controle total sobre o dinheiro através de sua conta Bcash.
                        </p>
                        <p>Tem dúvidas de como criar sua conta Bcash? Temos um {{ link_to_route('tutorial_bcash', 'mini-manual aqui')  }} que pode te ajudar!</p>
                    </div>

                    {{ Form::open(['route' => ['admin.register.integration', $championship->id]]) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('E-mail cadastrado no Bcash') }}
                                {{ Form::email('bcash_account', null, ['class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>
                    </div>

                    <div class="next-step">
                        <button type="submit" class="btn btn-success pull-right champ-button"><i class="icon icon-arrow-right"></i> Continuar</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">4</span>
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