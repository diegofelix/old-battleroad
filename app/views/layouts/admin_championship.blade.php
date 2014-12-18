@extends ('layouts.default')
@section ('content')

    @include ('partials._featured_title', ['title' => $championship->name])

    <div class="sub-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3 champ-sidebar">
                    @if ($championship->published)
                        <a href="{{ route('admin.championships.cancel', $championship->id) }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
                    @endif
                    <ul>
                        {{ champ_action_links('Informações', '', 'admin.championships.show', $championship->id, 'icon-info-circle'); }}
                        {{ champ_action_links('Banner', 'banner', 'admin.championships.banner', $championship->id, 'icon-camera'); }}
                        {{ champ_action_links('Jogos', 'games', 'admin.championships.games', $championship->id, 'icon-gamepad'); }}
                        {{ champ_action_links('Participantes', 'users', 'admin.championships.users', $championship->id, 'icon-users'); }}
                        {{-- champ_action_links('Feedback', 'feedback', 'admin.championships.feedback', $championship->id, 'icon-star'); --}}
                    </ul>

                    <hr>

                    <div class="alert alert-info">
                        <h4>Pagamentos Confirmados:</h4>
                        <h4 class="text-right">R$ {{ $championship->present()->totalConfirmedPrice() }}</h4>
                    </div>

                    <hr>

                    <div class="alert alert-warning">
                        <h4>Pagamentos Pendentes:</h4>
                        <h4 class="text-right">R$ {{ $championship->present()->totalPendentPrice() }}</h4>
                    </div>

                    <hr>

                    <div class="alert alert-success">
                        <h4>Previsão total dos recebimentos:</h4>
                        <h4 class="text-right">R$ {{ $championship->present()->totalPrice() }}</h4>
                    </div>

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