@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="icon icon-gamepad"></i> Jogos <small>Adicionando jogos ao campeonato.</small>
    </h3>

    {{ Form::open(['route' => 'admin.championships.games.store', 'role' => 'form']) }}

        {{ Form::hidden('id', $championship->id) }}

        <div class="form-group">
            <label for="game">Game</label>
            {{ Form::select('game_id', $games, 1, ['id' => 'game', 'class' => 'form-control']) }}
        </div>

        <div class="form-group">
            <label for="platform">Plataforma</label>
            {{ Form::select('platform_id', [1 => 'teste', 2 => 'games'], 1, ['id' => 'platform', 'class' => 'form-control']) }}
        </div>

        <div class="form-group">
            <label for="format">Formato</label>
            {{ Form::select('format_id', [1 => 'teste', 2 => 'games'], 1, ['id' => 'format', 'class' => 'form-control']) }}
        </div>

        <button type="submit" class="btn btn-info">Salvar</button>

    {{ Form::close() }}
@stop
