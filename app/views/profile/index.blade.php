@extends ('layouts.default')

@section ('content')

    @include('partials._featured_title', ['title' => 'Perfil do Usuário'])

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                {{ HTML::image(Auth::user()->picture) }}
            </div>
            <div class="col-md-9">
                <div class="bio">
                    <header>
                        <h3>Olá, meu nome é {{ Auth::user()->name }}! <span class="member-since"><em>Membro desde </em>{{ Auth::user()->created_at->format('M, Y') }}</span></h3>
                    </header>
                    @if ( ! $user->profile)
                        @include ('partials._no_profile')
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop