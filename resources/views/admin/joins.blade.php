@extends ('layouts.default')

@section('content')

    <div id="dashboard">

        <div class="container">

            <h2 class="main-title">Minhas inscrições</h2>

            <div class="panel panel-info">
                <div class="panel-heading">Campeonatos em que estou participando</div>
                <div class="panel-body">
                    <table class="champ-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Status</th>
                                <th>Organizador</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($joins as $join)
                                @if ($join->isActive())
                                    <tr>
                                        <td>{{ $join->championship->name }}</td>
                                        <td>{{ $join->status->name }}
                                        <td>{{ link_to_route('profile.show', $join->championship->user->name, $join->championship->user->username)}}
                                        <td><a href="{{ route('join.show', $join->id) }}"><span class="fa fa-eye"></span></a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop