@extends ('layouts.admin_register_2')

@section ('register_content')

    <h2 class="main-title">Cadastrando um Novo Campeonato</h2>

    <ol id="steps">
        <li>
            <div class="step-title">
                <span class="number">1</span>
                <h2>
                    Informações
                    <small>Como vai ser?</small>
                </h2>
            </div>
            <div class="row">
            <div class="step-content main-form col-md-12">
                {{ Form::open(['route' => 'admin.register.store', 'role' => 'form', 'files' => true]) }}

                        {{ Form::hidden('user_id', Auth::user()->id) }}

                        <fieldset>

                            <div class="form-group">
                                {{ Form::label('name', 'Nome:', ['class' => 'control-label']) }}
                                {{ Form::text('name', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nome do Campeonato',
                                    'id' => 'name',
                                    'required' => 'required'
                                ]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('name', 'Descrição:', ['class' => 'control-label']) }}
                                {{ Form::textarea('description', null, [
                                    'class' => 'form-control togglable-help',
                                    'placeholder' => 'Descrição do campeonato',
                                    'id' => 'description'
                                ]) }}
                                <span class="help-block hide">
                                    Você pode usar Markdown para estilizar a descrição do seu campeonato, só não exagere. <br>
                                    Não sabe usar o Markdown? Veja {{ link_to('http://battleroad.uservoice.com/knowledgebase/articles/339890-como-usar-o-markdown', 'como usar aqui.') }}
                                </span>
                            </div>

                            <div class="form-group">
                                {{ Form::label('name', 'Imagem:', ['class' => 'control-label']) }}
                                {{ Form::file('image', ['id' => 'image', 'class' => 'form-control togglable-help']) }}
                                <span class="help-block hide">
                                    É recomendado que você envie uma imagem de 1140x300 pixels, pois esse é o tamanho que mostraremos aos seus competidores.
                                </span>
                            </div>

                            <div class="form-group">
                                {{ Form::label('name', 'Data de Início:', ['class' => 'control-label']) }}
                                    {{ Form::text('event_start', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Data no formato: dd/mm/aaaa',
                                        'id' => 'event_start',
                                        'required' => 'required'
                                    ]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('location', 'Localização:', ['class' => 'control-label']) }}
                                {{ Form::text('location', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Online, Shopp Itaquera..',
                                    'id' => 'location',
                                    'required' => 'required'
                                ]) }}
                            </div>

                            <div class="form-group next-step">
                                <button type="submit" class="btn btn-success champ-button pull-right"><i class="icon icon-arrow-right"></i> Continuar</button>
                            </div>
                        </fieldset>
                {{ Form::close() }}
            </div>
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
        </li>
        <li>
            <div class="step-title">
                <span class="number">3</span>
                <h2>
                    Confirmação
                    <small>Tudo certo?</small>
                </h2>
            </div>
        </li>
    </ol>

@endsection
@section('scripts')
    {{ HTML::script('js/jquery-input-mask.js') }}
    {{ HTML::script('js/jquery-input-mask-date.js') }}
    {{ HTML::script('js/championship.js') }}
@stop