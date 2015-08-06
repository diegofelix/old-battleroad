@extends ('layouts.embeded')
@section('content')

    <div class="container">

        {{ Form::open(['route' => ['championships.embeded', $championship->id], 'method' => 'post']) }}

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="form-group">
                    <label for="name" class="control-label">Nome completo:</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="username" class="control-label">Nickname ( opcional ):</label>
                    <input type="text" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">E-mail:</label>
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email_confirmation" class="control-label">Confirme seu e-mail:</label>
                    <input type="text" name="email_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="rg" class="control-label">RG/Passaporte:</label>
                    <input type="text" name="rg" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar-se</button>
                </div>

            </div>
        </div>

        {{ Form::close() }}

    </div>

@stop