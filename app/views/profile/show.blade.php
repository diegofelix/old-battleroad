@extends ('layouts.default')

@section ('content')

    @include('partials._featured_title', ['title' => 'Perfil do Usuário'])

    <div id="user-profile">
        <div class="container">
            <div class="row">
                <figure class="col-md-3">
                    {{ HTML::image($user->picture, $user->name, ['class' => 'img-responsive']) }}
                    {{-- Check if the user logged is the same as the profile --}}
                    @if ($user->currentUser())
                        <div class="settings champ-box">
                            <header class="default-header">
                                <h3><i class="icon icon-gear"></i> Configurações</h3>
                            </header>
                            <section>
                                <ul class="settings-list">
                                    @if ($user->profile)
                                    <li><a href="{{ route('profile.edit', Auth::user()->username) }}"><i class="icon icon-user"></i> Editar Perfil</a></li>
                                    @endif
                                    <li><a href="#"><i class="icon icon-key"></i> Alterar Senha</a></li>
                                    <li><a href="{{ route('session.destroy') }}"><i class="icon icon-sign-out"></i> Sair</a></li>
                                </ul>
                            </section>
                        </div>
                    @endif
                </figure>
                <div class="col-md-9">
                    <div class="bio champ-box">
                        <header class="default-header">
                            <h3>Olá, meu nome é {{ $user->name }}! <span class="member-since pull-right"><em>Membro desde </em>{{ $user->created_at->format('M, Y') }}</span></h3>
                        </header>
                        <section>
                            @if ( ! $user->profile)
                                @include ('partials._no_profile')
                            @else
                                <p>{{ $user->profile->bio }}</p>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop