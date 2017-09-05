@extends ('layouts.default')

@section('title', 'Perfil de ' . Auth::user()->name)

@section ('content')

    @include('partials._featured_title', ['title' => 'Perfil do Usuário'])

    <div id="user-profile">
        <div class="container">
            <div class="row">
                <figure class="col-md-3">
                    {!! HTML::image(Auth::user()->present()->userImage, Auth::user()->name, ['class' => 'img-responsive']) !!}
                    {{-- Check if the user logged is the same as the profile --}}
                    <div class="settings champ-box">
                        <header class="default-header">
                            <h3><i class="fa fa-gear"></i> Configurações</h3>
                        </header>
                        <section>
                            <ul class="settings-list">
                                <li><a href="{{ route('profile.edit', Auth::user()->username) }}"><i class="fa fa-user"></i> Configurações</a></li>
                                <li><a href="#"><i class="fa fa-key"></i> Alterar Senha</a></li>
                                <li><a href="{{ route('session.destroy') }}"><i class="fa fa-sign-out"></i> Sair</a></li>
                            </ul>
                        </section>
                    </div>
                </figure>
                <div class="col-md-9">
                    <div class="panel panel-success">
                        <div class="panel-heading">Configurações</div>
                        <div class="panel-body">
                            {{ Form::model(Auth::user()->profile, ['route' => ['profile.update', Auth::user()->profile->id], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal']) }}

                                @include('profile._fields')

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop