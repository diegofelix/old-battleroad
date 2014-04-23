@extends ('layouts.admin_championship')
@section ('champ-content')
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
                <td class="platform">{{ HTML::image('images/platforms/ps3.jpg') }}</td>
                <td><a href="#" class="btn btn-default">Gerenciar</a></td>
            </tr>
            <tr>
                <td>{{ HTML::image('images/games/umvc3.jpg') }}</td>
                <td>ULTIMATE MARVEL VS CAPCOM 3</td>
                <td>Double Elimination</td>
                <td class="platform">{{ HTML::image('images/platforms/xbox360.jpg') }}</td>
                <td><a href="#" class="btn btn-default">Gerenciar</a></td>
            </tr>
        </tbody>
    </table>
@stop
