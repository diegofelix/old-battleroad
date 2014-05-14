@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="icon icon-gamepad"></i> Jogos <small>Adicionando jogos ao campeonato.</small>
    </h3>

    {{ Form::open(['route' => ['admin.championships.games.store', $championship->id], 'role' => 'form']) }}

        {{ Form::hidden('id', $championship->id) }}

        <div class="form-group">
            {{ Form::label('game', 'Game') }}
            <div class="input-group col-md-5">
                {{ Form::select('game_id', $games, 1, ['id' => 'game', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('platform', 'Plataforma') }}
            <div class="input-group col-md-5">
                {{ Form::select('platform_id', $formats, 1, ['id' => 'platform', 'class' => 'form-control']) }}
            </div>
            <span class="help-block">
                Não sabe o que significa cada formato? <a href="#">saiba aqui!</a>
            </span>
        </div>

        <div class="form-group">
            {{ Form::label('format', 'Formato') }}
            <div class="input-group col-md-5">
                {{ Form::select('format_id', $platforms, 1, ['id' => 'format', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('price', 'Preço (em Reais): ') }}
            <div class="input-group col-md-3">
                <span class="input-group-addon">R$</span>
                {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'required']) }}
            </div>
            <span class="help-block">
                O preço que você definir será o preço que receberá, com nossa taxa já aplicada.
            </span>
        </div>

        <div class="form-group">
            {{ Form::label('event_start', 'Data do Evento: ') }}
            <div class="input-group col-md-3">
                {{ Form::text('start', null, [
                    'class' => 'form-control',
                    'id' => 'event_start',
                    'placeholder' => 'Que horas começa?',
                    'required']) }}
            </div>
        </div>

        <button type="submit" class="btn btn-info">Salvar</button>

    {{ Form::close() }}
@stop