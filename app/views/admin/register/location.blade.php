@extends ('layouts.admin_register')

@section ('register_content')

    {{ Form::model($championship, ['route' => ['admin.register.storeLocation', $championship->id], 'role' => 'form', 'class' => 'form-horizontal', 'files' => true]) }}

        {{ Form::hidden('id', $championship->id) }}

        <div class="main-form">

            <div class="form-group">
                {{ Form::label('location', 'Localização', ['class' => 'col-md-2 control-label']) }}
                <div class="col-md-9">
                    {{ Form::text('location', null, [
                        'class' => 'form-control',
                        'id' => 'location',
                        'required' => 'required'
                    ]) }}
                    <span class="help-block">
                        Coloque o endereço da forma que você quiser, por exemplo: Online, Shopp Itaquera...
                    </span>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('price', 'Preço da Entrada (em Reais): ', ['class' => 'col-md-2 control-label']) }}
                <div class="col-md-9">
                    @include ('admin.register._price')
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('limit', 'Limite de pessoas: ', ['class' => 'col-md-2 control-label']) }}
                <div class="col-md-9">
                    {{ Form::text('limit', null, [
                        'class' => 'form-control',
                        'id' => 'limit'
                    ]) }}
                    <span class="help-block">
                        Preenchendo esse campo, faremos com que o limite de visitantes e participantes não ultrapasse a capacidade do lugar.<br />
                        Deixe em branco se não houver limite.
                    </span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                    <button type="submit" class="btn btn-success champ-button"><i class="icon icon-arrow-right"></i> Continuar</button>
                </div>
            </div>
        </div>

    {{ Form::close() }}

@endsection

@section ('scripts')
    {{ HTML::script('js/register.js') }}
@endsection