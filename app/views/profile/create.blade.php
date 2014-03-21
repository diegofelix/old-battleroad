@extends('layouts.default')

@section('content')
	@include('partials._featured_title', ['title' => 'Perfil de '. Auth::user()->name])

	{{ Form::open(['route' => 'profile.store', 'role' => 'form']) }}

		{{ FormField::bio(['placeholder' => 'Fale um pouco sobre você...']) }}

		{{ FormField::rg(['label' => 'RG:']) }}

		{{ FormField::cpf(['label' => 'CPF:']) }}

		{{ FormField::cep(['label' => 'CEP:']) }}

		{{ FormField::address(['label' => 'Endereço:']) }}

		{{ FormField::number(['label' => 'Número:']) }}

		{{ FormField::complement(['label' => 'Complemento:']) }}

		{{ FormField::city(['label' => 'Cidade:']) }}

		<div class="form-group">
			<label for="state" class="control-label">Estado:</label>
			<select name="state" class="form-control" id="state">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		</div>

	{{ Form::close() }}

@stop