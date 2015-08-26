@extends ('layouts.embeded')
@section('content')

    <div class="container">

        {{ Form::open(['route' => ['championships.embeded', $championship->id], 'method' => 'post']) }}

        <div class="row">

            <div class="col-xs-10 col-xs-offset-1">
                <div class="form-group {{ Session::has('error') && Session::get('error')->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="control-label">Nome completo:</label>
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @if (Session::has('error') && Session::get('error')->has('name'))
                        <p class="text-danger">{{ Session::get('error')->get('name')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="control-label">E-mail:</label>
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                    @if (Session::has('error') && Session::get('error')->has('email'))
                        <p class="text-danger">{{ Session::get('error')->get('email')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('email') ? 'has-error' : '' }}">
                    <label for="email_confirmation" class="control-label">Confirme seu e-mail:</label>
                    {{ Form::text('email_confirmation', null, ['class' => 'form-control']) }}
                    @if (Session::has('error') && Session::get('error')->has('email'))
                        <p class="text-danger">{{ Session::get('error')->get('email')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('identification') ? 'has-error' : '' }}">
                    <label for="identification" class="control-label">RG/Passaporte:</label>
                    {{ Form::text('identification', null, ['class' => 'form-control']) }}
                    @if (Session::has('error') && Session::get('error')->has('identification'))
                        <p class="text-danger">{{ Session::get('error')->get('identification')[0] }}</p>
                    @endif
                </div>

                @if ($championship->availableCompetitions()->count() > 1 )

                    <p class="help-block">Selecione os campeonatos que deseja participar:</p>

                    @foreach ($championship->availableCompetitions() as $competition)
                        <div class="checkbox {{ Session::has('error') && Session::get('error')->has('competitions') ? 'has-error' : '' }}">
                            <label>
                                <input type="checkbox" data-target="#form-nick-{{ $competition->id }}" name="competitions[]" value="{{ $competition->id  }}"> {{ $competition->game->name }}
                            </label>
                        </div>
                        <div class="form-group form-nick {{ Session::has('error') && Session::get('error')->has('nicks') ? 'has-error' : '' }}" id="form-nick-{{ $competition->id }}">
                            <label for="nicks" class="control-label">Nickname:
                            <input type="text" name="nicks[{{ $competition->id }}][]" class="form-control">
                            <small class="help-block">para esse jogo</small> </label>
                            @if (Session::has('error') && Session::get('error')->has('nicks'))
                                <p class="text-danger">{{ Session::get('error')->get('nicks')[0] }}</p>
                            @endif
                        </div>
                    @endforeach
                    @if (Session::has('error') && Session::get('error')->has('competitions'))
                        <p class="text-danger">{{ Session::get('error')->get('competitions')[0] }}</p>
                    @endif
                @else
                    <?php $competitionId = $championship->competitions->first()->id; ?>
                    <div class="form-group {{ Session::has('error') && Session::get('error')->has('nicks') ? 'has-error' : '' }}">
                        <label for="nicks" class="control-label">Nickname</label>
                        <input type="text" name="nicks[{{ $competitionId }}][]" class="form-control">
                        @if (Session::has('error') && Session::get('error')->has('nicks'))
                            <p class="text-danger">{{ Session::get('error')->get('nicks')[0] }}</p>
                        @endif
                    </div>
                    <input type="hidden", name="competitions[]" value="{{ $competitionId }}">
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar-se</button>
                </div>

            </div>
        </div>

        {{ Form::close() }}

    </div>

@stop
@section('scripts')
    @parent
    <script>
        $(function(){
            $('.form-nick').hide();

            var curTarget = $("input[type=checkbox]:checked").data('target');
            $(curTarget).show();

            $("input[type=checkbox]").on('change', function(){
                target = $(this).data('target');
                if (this.checked) {
                    $(target).fadeIn();
                } else {
                    $(target).fadeOut();
                }
            });
        });
    </script>
@stop