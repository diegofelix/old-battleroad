@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>
        <i class="icon icon-arrows"></i> Localização
    </h3>

    @if (Session::has('show-tutorial'))
        <div class="well alert-success">
            <h4>Certo. Seu campeonato está criado!</h4>
            <p>Agora precisamos adicionar o resto das informações para o seus participantes.</p>
            <p>Vamos começar adicionando o lugar onde será realizado o campeonato e o preço da Entrada ( se houver ).</p>
            <p>Coloque o endereço da forma que você quiser, por exemplo: Online, Shopp Itaquera...</p>
        </div>
    @endif

    {{ Form::open(['route' => ['admin.championships.storeLocation', $championship->id], 'method' => 'POST', 'role' => 'form']) }}

        {{ Form::hidden('id', $championship->id) }}

        <div class="form-group">
            {{ Form::label('location', 'Local:') }}
            {{ Form::text('location', null, ['class' => 'form-control input-lg', 'id' => 'location', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::label('price', 'Preço da Entrada (em Reais): ') }}
            <div class="input-group input-group-lg">
                <span class="input-group-addon">R$</span>
                {{ Form::text('price', null, ['class' => 'form-control input-lg', 'id' => 'price']) }}
            </div>
            <span class="help-block">
                O preço que você definir será o preço que receberá, com nossa taxa já aplicada.
            </span>
        </div>

        <button type="submit" class="btn btn-default champ-button">Salvar</button>

    {{ Form::close() }}

@stop
