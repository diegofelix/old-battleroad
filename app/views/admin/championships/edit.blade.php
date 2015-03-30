@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="fa fa-info-circle"></i> Atualizar Informações
    </h3>

    {{ Form::model($championship, ['route' => ['admin.championships.update', $championship->id]]) }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Título
        </div>
        <div class="panel-body">{{ Form::text('name', null, ['class' => 'form-control']) }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Descrição
        </div>
        <div class="panel-body">{{ Form::textarea('description', null, ['class' => 'form-control']) }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Twitch URL
        </div>
        <div class="panel-body">{{ Form::url('stream', null, ['class' => 'form-control']) }}</div>
    </div>

    <div class="alert alert-warning">
        Caso queira alterar mais alguma coisa, envie um e-mail para <a href="mailto:contato@battleroad.com.br">contato@battleroad.com.br</a> informando o motivo da alteração que entraremos em contato.
    </div>

    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>

    {{ Form::close() }}

@stop
