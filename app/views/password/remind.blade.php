@extends('layouts/default')
@section('content')

    <div class="featured-title">
        <div class="container">
            <h2>Resetar senha</h2>
        </div>
    </div>

    <div class="container" id="password-reminder">

        <p>
            Para resetar sua senha, digite abaixo o e-mail utilizado no cadastro. <br>
            Em instantes você receberá um e-mail para resetar a senha.
        </p>

        <div class="row">
            <div class="col-md-6">
                {{ Form::open() }}
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope icon-fw"></i></span>
                            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'required']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default btn-success">Enviar E-mail</button>

                {{ Form::close() }}
            </div>
        </div>
    </div>

@stop