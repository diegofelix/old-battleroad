@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="fa fa-gamepad"></i> Jogos <small>Adicionando jogos ao campeonato.</small>
    </h3>

    {{ Form::open(['route' => ['admin.register.games.store', $championship->id], 'role' => 'form']) }}

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
                {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price']) }}
            </div>
            <span class="help-block">
                O preço que você definir será o preço que receberá, com nossa taxa já aplicada.
            </span>
        </div>

        <div class="form-group">
            {{ Form::label('event_start', 'Data do Campeonato: ') }}
            <div class="input-group col-md-3">
                {{ Form::text('start', null, [
                    'class' => 'form-control',
                    'id' => 'event_start',
                    'placeholder' => 'Que dia começa?',
                    'required']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-md-3">
                <label for="limit-switch">
                    {{ Form::checkbox('limit_switch', 1, true, ['id' => 'limit-switch']) }}
                    Sem limite de participantes
                </label>
            </div>
        </div>

        <div id="limit-input" class="form-group hide">
            {{ Form::label('limit', 'Limite de participantes: ') }}
            <div class="input-group col-md-3">
                {{ Form::text('limit', null, [
                    'class' => 'form-control',
                    'id' => 'limit',
                    'placeholder' => 'Que dia começa?'
                ]) }}
            </div>
        </div>

        <button type="submit" class="btn btn-info">Salvar</button>

    {{ Form::close() }}
@stop
@section('scripts')
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    {{ HTML::script('js/games.js') }}
@stop