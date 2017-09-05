@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="fa fa-envelope"></i> Correio <small>Mande recado para os seus inscritos.</small>
    </h3>

    <hr>

    <div class="form">
        {{ Form::open(['route' => ['admin.championships.mail.store', $championship->id]]) }}

            <div class="form-group">
                {{ Form::text('subject', null, ['class' => 'form-control input-lg', 'placeholder' => 'Assunto']) }}
            </div>
            <div class="form-group">
                {{ Form::textarea('body', null, ['class' => 'form-control input-lg', 'placeholder' => 'Mensagem']) }}
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Enviar</button>

        {{ Form::close() }}
    </div>

@stop
@section('scripts')
    {!! HTML::script('js/register.js') !!}
@stop