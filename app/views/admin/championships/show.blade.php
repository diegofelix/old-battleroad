@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="icon icon-info-circle"></i> Informações
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">Descrição</div>
        <div class="panel-body">{{ $championship->description }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Local</div>
        <div class="panel-body">{{ $championship->location }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Taxa de Entrada</div>
        <div class="panel-body">{{ $championship->present()->userPrice }}</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Data do Evento</div>
        <div class="panel-body">{{ $championship->event_start }}</div>
    </div>

@stop
