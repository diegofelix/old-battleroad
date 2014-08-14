@extends ('layouts.admin_register')
@section ('register_content')

    <h3>
        <i class="icon icon-gamepad"></i> Jogos <small>Adicionando jogos ao campeonato.</small>
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
                    'id' => 'limit'
                ]) }}
            </div>
            @if ( ! empty($championship->limit))
                <div class="help-block">Máximo: {{ $championship->limit }}</div>
            @else
                <div class="help-block">Máximo: Ilimitado</div>
            @endif
        </div>

        <button type="submit" class="btn btn-info">Salvar</button>

    {{ Form::close() }}

@stop
@section('scripts')
    {{ HTML::script('js/jquery-input-mask.js') }}
    {{ HTML::script('js/jquery-input-mask-date.js') }}
    {{ HTML::script('js/games.js') }}
@stop