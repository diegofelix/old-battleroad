@extends ('layouts.admin_register')

@section ('register_content')

    {{ Form::open(['route' => 'admin.register.store', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true]) }}

        <div class="main-form">

            {{ Form::hidden('user_id', Auth::user()->id) }}

            <fieldset>

                <div class="form-group">
                    {{ Form::label('name', 'Nome:', ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::text('name', null, [
                            'class' => 'form-control',
                            'id' => 'name',
                            'required' => 'required'
                        ]) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('name', 'Descrição:', ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::textarea('description', null, [
                            'class' => 'form-control',
                            'id' => 'description'
                        ]) }}
                        <span class="help-block">
                            Você pode usar Markdown para estilizar a descrição do seu campeonato, só não exagere. <br>
                            Não sabe usar o Markdown? Veja {{ link_to('http://battleroad.uservoice.com/knowledgebase/articles/339890-como-usar-o-markdown', 'como usar aqui.') }}
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('name', 'Imagem:', ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::file('image', ['id' => 'image']) }}
                        <span class="help-block">
                            A imagem será cortada para 700x400, então é recomendado que já nos envie com esse tamanho pra melhor visualização.
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('name', 'Data de Início:', ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::text('event_start', null, [
                            'class' => 'form-control',
                            'id' => 'event_start',
                            'required' => 'required'
                        ]) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-2">
                        <button type="submit" class="btn btn-success champ-button"><i class="icon icon-arrow-right"></i> Continuar</button>
                    </div>
                </div>

            </fieldset>

        </div>

    {{ Form::close() }}

@endsection