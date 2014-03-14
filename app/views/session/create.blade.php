@extends ('layouts.default')

@section('content')

    <div class="container">
        <div id="login">
			{{ Form::open(['route' => 'session.store', 'role' => 'form']) }}

                <div class="form-group">
                    {{ Form::text('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'Login']) }}
                </div>

                <div class="form-group">
                    {{ Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password']) }}
                </div>

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('remember') }} Mantenha-me conectado
                    </label>
                </div>

                <span class="help-block pull-right"><a href="#">Esqueceu sua senha?</a></span>

                <button type="submit" class="btn btn-default btn-block btn-lg champ-button">Login</button>

            {{ Form::close() }}
        </div><!-- login -->
	</div><!-- container -->

@stop