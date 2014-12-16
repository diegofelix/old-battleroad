@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="fa fa-camera"></i> Banner
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            Banner
            <a href="{{ route('admin.championships.banner_edit', $championship->id) }}" class="pull-right btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</a>
        </div>
        <div class="panel-body">{{ HTML::image($championship->image, '', ['class' => 'img-responsive']) }}</div>
    </div>

@stop
