@extends ('layouts.default')

@section ('content')

    <div id="champ-create">

        @include ('partials._featured_title', ['title' => 'Criar Campeonato'])

        <div class="container">

            {{ Form::model($championship, ['route' => ['admin.championships.update', $championship->id], 'method' => 'PATCH', 'role' => 'form', 'files' => true]) }}

            <div class="container">
                <div class="main-form">

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

                    <button type="submit" class="btn btn-default champ-button">Salvar</button>
                </div>
            </div><!-- container -->

        </div><!-- container -->

        {{ Form::close() }}

    </div>

@endsection
@section('scripts')
    {{ HTML::script('js/bootstrap-datepicker.js') }}
@stop