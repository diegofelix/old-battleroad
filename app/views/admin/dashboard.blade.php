@extends ('layouts.default')

@section('content')

    <div id="dashboard">

        <div class="container">

            <h2 class="main-title">
                Dashboard
                <a href="{{ route('admin.register.index') }}" class="pull-right btn btn-success">
                    <span class="fa fa-plus"></span>
                     Registrar Novo Campeonato
                </a>
            </h2>
        
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