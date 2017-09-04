@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="fa fa-gamepad"></i> Jogos <small>Adicionando jogos ao campeonato.</small>
    </h3>

    {{ Form::model($competition, ['route' => ['admin.championships.games.store', $championship->id], 'role' => 'form']) }}

        {{ Form::hidden('id', $championship->id) }}

        <div class="form-group">
            {{ Form::label('game', 'Game') }}
            <div class="input-group col-md-5">
                {{ Form::select('game_id', $games, null, ['id' => 'game', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('platform', 'Plataforma') }}
            <div class="input-group col-md-5">
                {{ Form::select('platform_id', $formats, null, ['id' => 'platform', 'class' => 'form-control']) }}
            </div>
            <span class="help-block">
                Não sabe o que significa cada formato? <a href="#">saiba aqui!</a>
            </span>
        </div>

        <div class="form-group">
            {{ Form::label('format', 'Formato') }}
            <div class="input-group col-md-5">
                {{ Form::select('format_id', $platforms, null, ['id' => 'format', 'class' => 'form-control']) }}
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
            {{ Form::label('event_start', 'Data do Campeonato: ') }}
            <div class="input-group">
                <div class="col-md-6">
                    {{ Form::text('start', null, [
                        'class' => 'form-control',
                        'id' => 'event_start',
                        'placeholder' => 'Que horas começa?',
                        'required']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::select('format_id', ['11:00', '12:00', '13:00'], null, ['id' => 'format', 'class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-info">Salvar</button>

    {{ Form::close() }}
@stop