@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="fa fa-info-circle"></i> Informações
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            Descrição
            <a href="{{ route('admin.championships.edit', $championship->id) }}" class="pull-right btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</a>
        </div>
        <div class="panel-body">{{ $championship->present()->markdownDescription }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Local</div>
        <div class="panel-body">{{ $championship->location }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Data do Evento</div>
        <div class="panel-body">{{ $championship->event_start }}</div>
    </div>

@stop
