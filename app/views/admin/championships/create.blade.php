@extends ('layouts.default')

@section ('content')

    <div id="champ-create">

        @include ('partials._featured_title', ['title' => 'Criar Campeonato'])

        <div class="container">

            {{ Form::open(['route' => 'admin.championships.store', 'role' => 'form', 'files' => true]) }}

            <div class="main-form">

                {{ Form::hidden('user_id', Auth::user()->id) }}

                <div class="form-group">
                    {{ Form::label('name', 'Nome:') }}
                    {{ Form::text('name', null, [
                        'class' => 'form-control input-lg',
                        'id' => 'name',
                        'required' => 'required',
                        'placeholder' => 'Qual o nome?'
                    ]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Descrição:') }}
                    {{ Form::textarea('description', null, [
                        'class' => 'form-control input-lg',
                        'id' => 'description',
                        'placeholder' => 'Como vai ser?'
                    ]) }}
                    <span class="help-block">
                        Você pode usar Markdown para estilizar a descrição do seu campeonato, só não exagere. <br>
                        Não sabe usar o Markdown? Veja {{ link_to('http://battleroad.uservoice.com/knowledgebase/articles/339890-como-usar-o-markdown', 'como usar aqui.') }}
                    </span>
                </div>

                <div class="form-group">
                    {{ Form::label('image', 'Imagem:') }}
                    {{ Form::file('image', ['class' => 'form-control', 'id' => 'image']) }}
                    <span class="help-block">
                        A imagem será cortada para 700x400, então é recomendado que já nos envie com esse tamanho pra melhor visualização.
                    </span>
                </div>

                <div class="form-group">
                    {{ Form::label('event_start', 'Data do Evento: ') }}
                    {{ Form::text('event_start', null, [
                        'class' => 'form-control input-lg',
                        'id' => 'event_start',
                        'placeholder' => 'Quando começa?',
                        'required'
                    ]) }}
                </div>

                <button type="submit" class="btn btn-default champ-button">Salvar</button>
            </div>

        </div><!-- container -->

        {{ Form::close() }}

    </div>

@endsection
@section('scripts')
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    <script type="text/javascript">
        $('#event_start').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true
        });
    </script>
@stop