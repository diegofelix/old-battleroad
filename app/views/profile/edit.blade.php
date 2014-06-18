@extends('layouts.default')

@section('content')

    <div id="profile">

        @include('partials._featured_title', ['title' => 'Perfil de '. Auth::user()->name])

        <div class="container">

            {{ Form::model(Auth::user()->profile, ['route' => ['profile.update', Auth::user()->profile->id], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal']) }}

                <fieldset>

                    <legend>Dados Pessoais</legend>

                    <div class="form-group">
                        {{ Form::label('bio', 'Biografia: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-7">
                            {{ Form::textarea('bio', null, [
                                'class' => 'form-control',
                                'id' => 'bio',
                                'placeholder' => 'Fale um pouco sobre você...',
                                'rows' => '10',
                                'cols' => '10'
                            ]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone', 'Telefone: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-7">
                            {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'required']) }}
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <legend>Endereço</legend>

                    <div class="form-group">
                        {{ Form::label('zipcode', 'CEP: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-7">
                            {{ Form::text('zipcode', null, ['class' => 'form-control', 'id' => 'zipcode', 'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('address', 'Endereço: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-7">
                            {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('number', 'Número: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-2">
                            {{ Form::text('number', null, ['class' => 'form-control', 'id' => 'number', 'required']) }}
                        </div>
                        {{ Form::label('complement', 'Complemento: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-3">
                            {{ Form::text('complement', null, ['class' => 'form-control', 'id' => 'complement']) }}
                        </div>
                    </div>

                    <div class="form-group">

                    </div>

                    <div class="form-group">
                        {{ Form::label('city', 'Cidade: ', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-7">
                            {{ Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state" class="col-md-2 control-label">Estado:</label>
                        <div class="col-md-7">
                            {{ Form::select('state', Champ\State\State::lists('name', 'abbr'), null, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div><!-- form group -->

                </fieldset>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default champ-button">Salvar</button>
                    </div>
                </div>

            {{ Form::close() }}

        </div><!-- container -->

    </div>

@stop