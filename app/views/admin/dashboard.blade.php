@extends ('layouts.default')

@section('content')

    <div id="championship">
        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Dashboard
                </h2>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="panel panel-warning">
            <div class="panel-heading">Meus Campeonatos</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Status</th>
                            <th>Participantes</th>
                            <th>Gerenciar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($championships as $championship)
                            <tr>
                                <td>{{ $championship->name }}</td>
                                <td>{{ ($championship->published) ? 'Publicado' : 'Não publicado' }}</td>
                                <td>{{ $championship->joins->count() }}</td>
                                <td><a href="{{ route('admin.championships.show', $championship->id) }}"><span class="icon icon-cog"></span> Gerenciar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">Campeonatos que estou participando</div>
            <div class="panel-body">
                <table class="table table-striped">
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
                                <td><a href="{{ route('join.show', $join->id) }}"><span class="icon icon-eye"></span> Detalhes</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@stop