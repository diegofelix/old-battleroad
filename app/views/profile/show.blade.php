@extends ('layouts.default')

@section('title', 'Perfil de ' . $user->name)
@section('meta')
    <meta property="og:image" content="{{ HTML::image($user->present()->userImage, $user->name, ['class' => 'img-responsive']) }}"/>
@stop

@section ('content')

    @include('partials._featured_title', ['title' => $user->name ])

    <div id="user-profile">
        <div class="container">
            <div class="row">
                <figure class="col-md-3">
                    {{ HTML::image($user->present()->userImage, $user->name, ['class' => 'img-responsive']) }}
                    {{-- Check if the user logged is the same as the profile --}}
                    @if ($user->currentUser())
                        <div class="settings champ-box">
                            <header class="default-header">
                                <h3><i class="fa fa-gear"></i> Configurações</h3>
                            </header>
                            <section>
                                <ul class="settings-list">
                                    <li>
                                        <?php $route = ($user->profile) ? 'profile.edit': 'profile.create' ?>
                                        <a href="{{ route($route, Auth::user()->username) }}"><i class="fa fa-user"></i> Configurações</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-key"></i> Alterar Senha</a></li>
                                    <li><a href="{{ route('session.destroy') }}"><i class="fa fa-sign-out"></i> Sair</a></li>
                                </ul>
                            </section>
                        </div>
                    @endif
                </figure>
                <div class="col-md-9">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Olá, meu nome é {{ $user->name }}
                            <span class="pull-right"><em>Membro desde </em>{{ $user->created_at->format('M, Y') }}</span>
                        </div>
                        <div class="panel-body">
                            @if ( ! $user->profile)
                                @include ('partials._no_profile')
                            @else
                                <p>{{ $user->profile->bio }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @if ( ! empty($user->profile->psn))
                            <div class="col-md-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">PSN</div>
                                    <div class="panel-body">
                                        {{{ $user->profile->psn }}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ( ! empty($user->profile->live))
                            <div class="col-md-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">XBOX Live</div>
                                    <div class="panel-body">
                                        {{{ $user->profile->live }}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ( ! empty($user->profile->steam))
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Steam</div>
                                    <div class="panel-body">
                                        {{{ $user->profile->steam }}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop