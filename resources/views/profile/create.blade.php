@extends('layouts.default')

@section('content')

	<div id="profile">

		@include('partials._featured_title', ['title' => 'Perfil de '. Auth::user()->name])

		<div class="container">

			{!! Form::open(['route' => 'profile.store', 'role' => 'form', 'class' => 'form-horizontal']) !!}

				{!! Form::hidden('user_id', Auth::user()->id) !!}

				@include('profile._fields')

			{!! Form::close() !!}

		</div><!-- container -->

	</div>

@stop
@section('scripts')
    {!! HTML::script('js/jquery-input-mask.js') !!}
    {!! HTML::script('js/jquery-input-mask-date.js') !!}
    {!! HTML::script('js/profile.js') !!}
@stop