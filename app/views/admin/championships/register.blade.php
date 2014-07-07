@extends ('layouts.default')

@section ('content')

    <div id="championship">

         <div class="featured-title championship">
            <div class="container">
                <h2>
                    Crie seu campeonato
                </h2>
            </div>
        </div>

        <div class="container">

            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="active"><a href="#">Informações</a></li>
                <li><a href="#">Localização</a></li>
                <li><a href="#">Participantes</a></li>
                <li><a href="#">Jogos</a></li>
            </ul>

            <hr />

            {{ Form::open(['route' => 'admin.championships.store', 'role' => 'form', 'files' => true]) }}

                <div class="main-form">

                    {{ Form::hidden('user_id', Auth::user()->id) }}

                    <div class="form-group">
                        {{ Form::text('name', null, [
                            'class' => 'form-control input-lg',
                            'id' => 'name',
                            'required' => 'required',
                            'placeholder' => 'Título do Campeonato'
                        ]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::textarea('description', null, [
                            'class' => 'form-control input-lg',
                            'id' => 'description',
                            'placeholder' => 'Descreva como vai ser o campeonato.'
                        ]) }}
                        <span class="help-block">
                            Você pode usar Markdown para estilizar a descrição do seu campeonato, só não exagere. <br>
                            Não sabe usar o Markdown? Veja {{ link_to('http://battleroad.uservoice.com/knowledgebase/articles/339890-como-usar-o-markdown', 'como usar aqui.') }}
                        </span>
                    </div>

                    <div class="form-group">
                        {{ Form::file('image', ['class' => 'form-control', 'id' => 'image']) }}
                        <span class="help-block">
                            A imagem será cortada para 700x400, então é recomendado que já nos envie com esse tamanho pra melhor visualização.
                        </span>
                    </div>

                    <div class="form-group">

                        {{ Form::text('event_start', null, [
                            'class' => 'form-control input-lg',
                            'id' => 'event_start',
                            'placeholder' => 'Quando começa?',
                            'required'
                        ]) }}
                    </div>

                    <button type="submit" class="btn btn-default champ-button">Continuar</button>
                </div>

            {{ Form::close() }}

        </div>

    </div><!-- championship -->

@endsection