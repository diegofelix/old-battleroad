@extends ('layouts.default')

@section('title', $championship->name)

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <figure>
                    {{ HTML::image($championship->image) }}
                </figure>
                <section championship-minidetails>
                    <h2>
                        {{ $championship->name }}
                        <div class="pull-right addthis_sharing_toolbox">
                    </h2>
                </section>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">Descrição</div>
                        <div class="panel-body">
                            {{ $championship->present()->markdownDescription }}
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Competições</div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Jogo</th>
                                    <th>Formato</th>
                                    <th>Plataforma</th>
                                    <th>Vagas</th>
                                    <th>Inscrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($championship->competitions as $competition)
                                    <tr>
                                        <td>{{{ $competition->game->name }}}</td>
                                        <td>{{{ $competition->format->name }}}</td>
                                        <td>{{{ $competition->platform->name }}}</td>
                                        <td>{{{ $competition->present()->trueLimit }}} Restantes</td>
                                        <td>{{ $competition->present()->userPrice }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações</div>
                        <ul class="list-group">
                            <li class="list-group-item">Av Engenheiro Armando de Arruda Pereira, 1370, Jabaquara SP</li>
                            <li class="list-group-item"><strong>{{{ $championship->limit }}}</strong> Vagas restantes</li>
                            <li class="list-group-item">{{ $championship->present()->userPrice }}</li>
                            <li class="list-group-item">{{{ $championship->present()->daysLeft }}}</li>
                        </ul>
                        <div class="panel-body">
                            {{ link_to_route('join.create', 'Quero Participar!', $championship->id, ['class' => 'btn btn-block btn-lg btn-success']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- championship -->

@endsection
@section('scripts')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e299d075914d81"></script>
@stop