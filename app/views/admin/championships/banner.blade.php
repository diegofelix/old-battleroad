@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="icon icon-camera"></i> Banner
        <a href="#" class="btn btn-info btn-lg pull-right">Trocar Imagem</a>
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">Banner</div>
        <div class="panel-body">{{ HTML::image($championship->image, '', ['class' => 'img-responsive']) }}</div>
    </div>

@stop
