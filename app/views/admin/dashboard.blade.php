@extends ('layouts.default')

@section('content')

    <div id="dashboard">
        {{--
        <div id="dashboard-bar" class="container">

            <!-- <div class="container"> -->
                <div class="row">
                    <div class="dashboard-item col-md-4">
                        <h3>
                            <!-- <span class="fa fa-dollar"></span> -->
                            <small>R$</small>108,90
                        </h3>
                    </div>
                    <div class="dashboard-item col-md-4">
                        <h3>
                            <!-- <span class="fa fa-trophy"></span> -->
                            2 Campeonatos
                        </h3>
                    </div>
                    <div class="dashboard-item col-md-4">
                        <h3>
                            <!-- <span class="fa fa-users"></span> -->
                            5 Organizações
                        </h3>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        --}}

        <div class="container">

            <h2 class="main-title">
                Dashboard
                <a href="{{ route('admin.register.index') }}" class="pull-right btn btn-success">
                    <span class="fa fa-plus"></span>
                     Registrar Novo Campeonato
                </a>
            </h2>
            {{--
            <div class="panel panel-default">
                <div class="panel-heading">Campeonatos que estou participando</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Organizador</th>
                                <th>Status</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($joins as $join)
                                <tr>
                                    <td>{{ $join->championship->name }}</td>
                                    <td>{{ $join->user->name }}</td>
                                    <td>{{ $join->status->name }}</td>
                                    <td><a href="{{ route('join.show', $join->id) }}"><span class="fa fa-eye"></span> Detalhes</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            --}}

            <div class="panel panel-warning">
                <div class="panel-heading">Meus Campeonatos</div>
                <div class="panel-body">
                    <table class="champ-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Status</th>
                                <th>Participantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($championships as $championship)
                                <tr>
                                    <td>{{ $championship->name }}</td>
                                    <td>
                                        @if ($championship->published)
                                            <span class="fa fa-toggle-on"></span>
                                        @else
                                            <span class="fa fa-toggle-off"></span>
                                        @endif
                                    </td>
                                    <td>{{ $championship->joins->count() }}</td>
                                    <td><a href="{{ route('admin.championships.show', $championship->id) }}"><span class="fa fa-cog"></span></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop