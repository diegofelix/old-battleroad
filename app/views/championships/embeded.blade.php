@extends ('layouts.embeded')
@section('content')

    <div class="container">

        {{ Form::open(['route' => ['championships.embeded', $championship->id], 'method' => 'post']) }}

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="form-group">
                    <label for="name" class="control-label">Nome completo:</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">E-mail:</label>
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email_confirmation" class="control-label">Confirme seu e-mail:</label>
                    <input type="text" name="email_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="identification" class="control-label">RG/Passaporte:</label>
                    <input type="text" name="identification" class="form-control">
                </div>

                @if ($championship->competitions->count() > 1 )

                    <p class="help-block">Selecione os campeonatos que deseja participar:</p>

                    @foreach ($championship->competitions as $competition)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" data-target="#form-nick-{{ $competition->id }}" name="competitions[]" value="{{ $competition->id  }}"> {{ $competition->game->name }}
                            </label>
                        </div>
                        <div class="form-group form-nick" id="form-nick-{{ $competition->id }}">
                            <label for="username" class="control-label">Nickname:
                            <input type="text" name="nicks[{{ $competition->id }}][]" class="form-control">
                            <small class="help-block">para esse jogo</small> </label>
                        </div>
                    @endforeach
                @else
                    <?php $competitionId = $championship->competitions->first()->id; ?>
                    <div class="form-group">
                        <label for="username" class="control-label">Nickname</label>
                        <input type="text" name="nicks[{{ $competitionId }}][]" class="form-control">
                    </div>
                    {{ Form::hidden('competitions[]', $competitionId) }}
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