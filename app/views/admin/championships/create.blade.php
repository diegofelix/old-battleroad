@extends ('layouts.default')

@section ('content')

    <div id="champ-create">

        @include ('partials._featured_title', ['title' => 'Criar Campeonato'])

        <div class="container">

            {{ Form::open(['route' => 'admin.championships.store', 'role' => 'form', 'files' => true]) }}

            <div class="container">
                <div class="main-form">

                    {{ Form::hidden('user_id', Auth::user()->id) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Nome:') }}
                        {{ Form::text('name', null, ['class' => 'form-control input-lg', 'id' => 'name', 'required']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Descrição:') }}
                        {{ Form::textarea('description', null, [
                            'class' => 'form-control input-lg',
                            'id' => 'description',
                            'placeholder' => 'Fale como será o campeonato.'
                        ]) }}
                        <span class="help-block">
                            Você pode usar Markdown para estilizar a descrição do seu campeonato, só não exagere. <br>
                            Não sabe usar o Markdown? Veja {{ link_to('http://battleroad.uservoice.com/knowledgebase/articles/339890-como-usar-o-markdown', 'como usar aqui.') }}
                        </span>
                    </div>

                    <div class="form-group">
                        {{ Form::label('image', 'Imagem:') }}
                        {{ Form::file('image', ['class' => 'form-control input-lg', 'id' => 'image']) }}
                        <span class="help-block">
                            A imagem será cortada para 700x400, então é recomendado que já nos envie com esse tamanho pra melhor visualização.
                        </span>
                    </div>

                    <div class="form-group">
                        {{ Form::label('location', 'Local:') }}
                        {{ Form::text('location', null, ['class' => 'form-control input-lg', 'id' => 'location', 'required']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('price', 'Preço Entrada (em Reais): ') }}
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">R$</span>
                            {{ Form::text('price', null, ['class' => 'form-control input-lg', 'id' => 'price', 'required']) }}
                        </div>
                        <span class="help-block">
                            O preço que você definir será o preço que receberá, com nossa taxa já aplicada.
                        </span>
                    </div>

                    <div class="form-group">
                        {{ Form::label('event_start', 'Data do Evento: ') }}
                        {{ Form::text('event_start', null, [
                            'class' => 'form-control input-lg',
                            'id' => 'event_start',
                            'placeholder' => 'Que horas começa?',
                            'required']) }}
                    </div>

                    <button type="submit" class="btn btn-default champ-button">Salvar</button>
                </div>
            </div><!-- container -->

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