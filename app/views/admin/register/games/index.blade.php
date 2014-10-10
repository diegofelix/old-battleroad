@extends ('layouts.admin_register_2')
@section ('register_content')

    <ol id="steps">
        <li>
            <div class="step-title step-finished">
                <span class="number">1</span>
                <h2>
                    Informações
                    <small>Como vai ser?</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">2</span>
                <h2>
                    Jogos
                    <small>Quais jogos?</small>
                </h2>
            </div>
            <div class="row">
                <div class="step-content col-md-12">

                    <div class="mini-helper warning">
                        <p>Agora precisamos criar os jogos que farão parte do seu campeonato.</p>
                        <p>Clique em "Adicionar jogo" para adicionar um jogo, definir preço, tipo de eliminação e etc.</p>
                    </div>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-game">
                        <span class="icon icon-plus"></span> Jogo
                    </button>

                    <table class="table table-striped table-hover games-table">
                        <thead>
                            <tr>
                                <th>Jogo</th>
                                <th>Formato</th>
                                <th>Plataforma</th>
                                <th>Preço</th>
                                <th>Data</th>
                                <th>Remover?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($championship->competitions as $competition)
                                <tr>
                                    <td>{{ $competition->game->name }}</td>
                                    <td>{{ $competition->format->name }}</td>
                                    <td>{{ HTML::image($competition->platform->icon) }}</td>
                                    <td>{{ $competition->present()->userPrice }}</td>
                                    <td>{{ $competition->start }}</td>
                                    <td>
                                        {{ Form::open(['route' => ['admin.register.games.destroy', $championship->id, $competition->id], 'method' => 'DELETE', 'role' => 'form']) }}
                                            <button type="submit" class="btn btn-danger">
                                                <i class="icon icon-times-circle"></i>
                                            </button>
                                        {{ Form::close() }}
                                        {{--
                                            link_to_route(
                                                'admin.championships.games.delete',
                                                'Remover',
                                                [$championship->id, $competition->id],
                                                ['class' => 'btn btn-danger']
                                        )--}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="form-group next-step">
                        <a href="{{ route('admin.register.integration', $championship->id) }}" class="btn btn-success pull-right champ-button"><i class="icon icon-arrow-right"></i> Continuar</a>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">3</span>
                <h2>
                    Sistema de Pagamento
                    <small>Integre à sua conta Mercado Livre</small>
                </h2>
            </div>
        </li>
        <li>
            <div class="step-title">
                <span class="number">4</span>
                <h2>
                    Confirmação
                    <small>Tudo certo?</small>
                </h2>
            </div>
        </li>
    </ol>

<div class="modal fade" id="add-game">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(['route' => ['admin.register.games.store', $championship->id], 'role' => 'form']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Adicionando um novo jogo ao campeonato</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            {{ Form::hidden('id', $championship->id) }}

                            <div class="form-group">
                                {{ Form::label('game', 'Game') }}
                                {{ Form::select('game_id', $games, 1, ['id' => 'game', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('platform', 'Plataforma') }}
                                {{ Form::select('platform_id', $formats, null, ['id' => 'platform', 'class' => 'form-control']) }}
                                <span class="help-block">
                                    Não sabe o que significa cada formato? <a href="#">saiba aqui!</a>
                                </span>
                            </div>

                            <div class="form-group">
                                {{ Form::label('format', 'Formato') }}
                                {{ Form::select('format_id', $platforms, null, ['id' => 'format', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('price', 'Preço da Entrada (em Reais): ') }}
                                @include ('admin.register._price')
                            </div>

                            <div class="form-group">
                                {{ Form::label('event_start', 'Data do Campeonato: ') }}
                                <div class="input-group col-md-6">
                                    <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                    {{ Form::text('start', null, [
                                        'class' => 'form-control',
                                        'id' => 'event_start',
                                        'required']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="limit-switch">
                                    {{ Form::checkbox('limit_switch', 1, true, ['id' => 'limit-switch']) }}
                                    Sem limite de participantes
                                </label>
                            </div>

                            <div class="row">
                                <div id="limit-input" class="form-group hide col-md-3">
                                    {{ Form::label('limit', 'Limite de participantes: ') }}

                                    {{ Form::text('limit', null, [
                                        'class' => 'form-control',
                                        'id' => 'limit'
                                    ]) }}

                                    @if ( ! empty($championship->limit))
                                        <div class="help-block">Máximo: {{ $championship->limit }}</div>
                                    @else
                                        <div class="help-block">Máximo: Ilimitado</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info">Salvar</button>
                </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop
@section('scripts')
    {{ HTML::script('js/jquery-input-mask.js') }}
    {{ HTML::script('js/jquery-input-mask-date.js') }}
    {{ HTML::script('js/games.js') }}
    {{ HTML::script('js/register.js') }}
@stop