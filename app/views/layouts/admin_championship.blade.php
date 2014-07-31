@extends ('layouts.default')
@section ('content')

    @include ('partials._featured_title', ['title' => $championship->name])

    <div class="sub-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3 champ-sidebar">
                    @if ($championship->published)
                        <a href="#" class="btn btn-success btn-lg btn-block disabled">Publicado</a>
                    @endif
                    <ul>
                        {{ champ_action_links('Informações', '', 'admin.championships.show', $championship->id, 'icon-info-circle'); }}
                        {{ champ_action_links('Banner', 'banner', 'admin.championships.banner', $championship->id, 'icon-camera'); }}
                        {{ champ_action_links('Jogos', 'games', 'admin.championships.games', $championship->id, 'icon-gamepad'); }}
                        {{ champ_action_links('Participantes', 'users', 'admin.championships.users', $championship->id, 'icon-users'); }}
                        {{ champ_action_links('Feedback', 'feedback', 'admin.championships.feedback', $championship->id, 'icon-star'); }}
                    </ul>
                </div><!-- champ-sidebar -->

                <div class="col-md-9 champ-description">
                    @yield('champ-content')
                </div><!-- champ-description -->

            </div><!-- row -->
        </div><!-- container -->
    </div><!-- champ-manage -->
@stop

@section('scripts')
    {{ HTML::script('js/bootstrap-datepicker.js') }}
@stop