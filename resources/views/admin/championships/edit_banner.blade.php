@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="fa fa-camera"></i> Atualizar Banner
    </h3>

    {!! Form::open(['route' => ['admin.championships.banner_update', $championship->id], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Banner
        </div>
        <div class="panel-body">{!! Form::file('image', ['class' => 'form-control']) !!}</div>
    </div>

    <div class="alert alert-info">
        É recomendado que você envie uma imagem de 1140x300 pixels, pois esse é o tamanho que mostraremos aos seus competidores.
    </div>

    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>

    {!! Form::close() !!}

@stop
