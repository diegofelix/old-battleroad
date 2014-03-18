@extends ('layouts.default')

@section ('content')

    <div class="featured-title">
        <div class="container">
            <h2>Perfil do usuário</h2>
        </div>
    </div>

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
                    <section>
                        <p>{{ Auth::user()->bio ?: 'Ainda não tenho uma biografia =/' }}</p>
                    </section>
                </div>
            </div>
        </div>
    </div>

@stop