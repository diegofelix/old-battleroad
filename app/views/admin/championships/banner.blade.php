@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="icon icon-camera"></i> Banner
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">Banner</div>
        <div class="panel-body">{{ HTML::image($championship->image, '', ['class' => 'img-responsive']) }}</div>
    </div>

@stop
