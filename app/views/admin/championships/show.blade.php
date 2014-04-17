@extends ('layouts.default')
@section ('content')

    @include ('partials._featured_title', ['title' => $championship->name])

    <div class="sub-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3 champ-sidebar">
                    <a href="#" class="btn btn-success btn-lg btn-block">Publicar</a>

                    <ul>
                        <li><a href="#"><i class="pull-right icon icon-info-circle"></i> Informações</a></li>
                        <li><a href="#"><i class="pull-right icon icon-camera"></i> Banner</a></li>
                        <li class="active"><a href="#"><i class="pull-right icon icon-gamepad"></i> Jogos</a></li>
                        <li><a href="#"><i class="pull-right icon icon-users"></i> Participantes</a></li>
                        <li><a href="#"><i class="pull-right icon icon-star"></i> Feedback</a></li>
                    </ul>

                </div><!-- champ-sidebar -->
                <div id="description" class="col-md-9">
                    <h3>
                        <i class="icon icon-gamepad"></i> Jogos
                        <a href="#" class="btn btn-info btn-lg pull-right">Adicionar jogo</a>
                    </h3>
                    <table class="table table-striped table-hover games-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jogo</th>
                                <th>Formato</th>
                                <th>Plataforma</th>
                                <th>Administrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ HTML::image('images/games/ssfivae.jpg') }}</td>
                                <td>SUPER STREET FIGHTER IV: ARCADE EDITION V.2012</td>
                                <td>Double Elimination</td>
                                <td>{{ HTML::image('images/platforms/ps3.jpg') }}</td>
                                <td><a href="#" class="btn btn-default">Gerenciar</a></td>
                            </tr>
                            <tr>
                                <td>{{ HTML::image('images/games/umvc3.jpg') }}</td>
                                <td>ULTIMATE MARVEL VS CAPCOM 3</td>
                                <td>Double Elimination</td>
                                <td>{{ HTML::image('images/platforms/xbox360.jpg') }}</td>
                                <td><a href="#" class="btn btn-default">Gerenciar</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- champ-description -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- champ-manage -->
@stop
