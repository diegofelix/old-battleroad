@extends ('layouts.default')

@section('content')

    <div class="featured-title">
        <div class="container">
            <h2>Cadastrate-se</h2>
        </div>
    </div>

    <div class="container" id="register">

        <div class="row">

            <div class="col-md-6">

                <h5>Já tem cadastro? {{ link_to_route('session.create', 'faça o login.') }}</h5>

                <p></p>

                {{ Form::open(['route' => 'register.store', 'role' => 'form']) }}

                    <div class="form-group has-error has-feedback">
                        {{ Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => 'Nome', 'required']) }}
                        <span class="icon icon-times form-control-feedback"></span>
                    </div>

                    <div class="form-group">
                        {{ Form::text('username', null, ['class' => 'form-control input-lg', 'placeholder' => 'Nick', 'required']) }}
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon icon-envelope icon-fw"></i></span>
                            {{ Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'E-mail', 'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon icon-key icon-fw"></i></span>
                                {{ Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password', 'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon icon-key icon-fw"></i></span>
                            {{ Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => 'Repita a senha', 'required']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default btn-block btn-lg champ-button">Cadastrar</button>

                {{ Form::close() }}

            </div><!-- login-form -->

            <div class="social-networks col-md-5 col-md-offset-1">

                <p>Cansado de digitar formulários? Entre com sua conta do Google ou facebook, é muito mais rápido!</p>

                <div class="networks">
                    <ul>
                        <li>{{ link_to_route('auth.facebook', 'Facebook', null, ['class' => 'btn btn-default btn-block btn-facebook']) }}</li>
                        <li>{{ link_to_route('auth.google', 'Google', null, ['class' => 'btn btn-default btn-block btn-google']) }}</li>
                    </ul>
                </div>

            </div>

        </div><!-- row -->

    </div><!-- container -->

@stop