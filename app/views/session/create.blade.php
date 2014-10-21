@extends ('layouts.default')

@section('content')
    <div id="login">
        <div class="container">

            <div class="row">

                <div class="login-form col-md-6 col-md-offset-3">

                    <div class="social-networks">

                        <h5>Entre usando sua conta:</h5>

                        <div class="networks">
                            <ul>
                                <li>{{ link_to_route('auth.facebook', 'Facebook', null, ['class' => 'btn btn-default btn-facebook']) }}</li>
                                <li>{{ link_to_route('auth.google', 'Google', null, ['class' => 'btn btn-default btn-google']) }}</li>
                            </ul>
                        </div>

                        <div class="separator">
                            <p>ou</p>
                        </div>

                    </div>

        			{{ Form::open(['route' => 'session.store', 'role' => 'form']) }}

                        <div class="form-group">
                            {{ Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'E-mail', 'required']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password', 'required']) }}
                        </div>

                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('remember') }} Mantenha-me conectado
                            </label>
                        </div>

                        <span class="help-block pull-right"><a href="#">Esqueceu sua senha?</a></span>

                        <button type="submit" class="btn btn-default btn-block btn-lg champ-button">Login</button>

                    {{ Form::close() }}

                </div><!-- login-form -->

            </div><!-- row -->

    	</div><!-- container -->
    </div>

@stop