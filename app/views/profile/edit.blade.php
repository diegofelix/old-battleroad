@extends('layouts.default')

@section('content')

    <div id="profile">

        @include('partials._featured_title', ['title' => 'Perfil de '. Auth::user()->name])

        <div class="container">

            {{ Form::model(Auth::user()->profile, ['route' => ['profile.update', Auth::user()->profile->id], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal']) }}

                @include('profile._fields')

            {{ Form::close() }}

        </div><!-- container -->

    </div>

@stop