@extends('layouts/default')
@section('content')

    <div class="featured-title">
        <div class="container">
            <h2>Resetar senha</h2>
        </div>
    </div>

    <div class="container" id="password-reminder">

        <p>Preencha seu e-mail com sua nova senha e confirme.</p>

        <div class="row">
            <div class="col-md-6">
                {!! Form::open() !!}

                    {!! Form::hidden('token', $token) !!}

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope icon-fw"></i></span>
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key icon-fw"></i></span>
                                {!! Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key icon-fw"></i></span>
                            {!! Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => 'Repita a senha', 'required']) !!}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default btn-success">Salvar</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop