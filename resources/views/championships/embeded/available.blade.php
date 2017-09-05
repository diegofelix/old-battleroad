@extends ('layouts.embeded')
@section('content')

    <div class="container">

        {!! Form::open(['route' => ['championships.embeded', $championship->id], 'method' => 'post']) !!}

        <div class="row">

            <div class="col-xs-10 col-xs-offset-1">
                <div class="form-group {{ Session::has('error') && Session::get('error')->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="control-label">Nome/Name/Nombre:</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if (Session::has('error') && Session::get('error')->has('name'))
                        <p class="text-danger">{{ Session::get('error')->get('name')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('birthdate') ? 'has-error' : '' }}">
                    <label for="birthdate" class="control-label">Data de Nascimento/Birthdate/Fecha de Nacimiento:</label>
                    {!! Form::text('birthdate', null, ['class' => 'form-control']) !!}
                    @if (Session::has('error') && Session::get('error')->has('birthdate'))
                        <p class="text-danger">{{ Session::get('error')->get('birthdate')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="control-label">E-mail:</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    @if (Session::has('error') && Session::get('error')->has('email'))
                        <p class="text-danger">{{ Session::get('error')->get('email')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('email') ? 'has-error' : '' }}">
                    <label for="email_confirmation" class="control-label">Confirme seu E-mail/Confirm your E-mail/Confirma tu E-mail:</label>
                    {!! Form::text('email_confirmation', null, ['class' => 'form-control']) !!}
                    @if (Session::has('error') && Session::get('error')->has('email'))
                        <p class="text-danger">{{ Session::get('error')->get('email')[0] }}</p>
                    @endif
                </div>

                <div class="form-group {{ Session::has('error') && Session::get('error')->has('identification') ? 'has-error' : '' }}">
                    <label for="identification" class="control-label">RG ou CPF/Passport/Pasaporte:</label>
                    {!! Form::text('identification', null, ['class' => 'form-control']) !!}
                    @if (Session::has('error') && Session::get('error')->has('identification'))
                        <p class="text-danger">{{ Session::get('error')->get('identification')[0] }}</p>
                    @endif
                </div>

                @if ($championship->competitions->count() > 1 )

                    <p class="help-block">Selecione os campeonatos que deseja participar:</p>

                    @foreach ($championship->competitions as $competition)
                        <div class="checkbox {{ Session::has('error') && Session::get('error')->has('competitions') ? 'has-error' : '' }}">
                            <label>
                                <input type="checkbox" data-target="#form-nick-{{ $competition->id }}" name="competitions[]" value="{{ $competition->id  }}"> {{ $competition->game->name }}
                            </label>
                        </div>
                        <div class="form-group form-nick {{ Session::has('error') && Session::get('error')->has('nicks') ? 'has-error' : '' }}" id="form-nick-{{ $competition->id }}">
                            <label for="nicks" class="control-label">Nickname Profissional:
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
                    <?php
                        $competition   = $championship->competitions->first();
                        $competitionId = $competition->id;
                    ?>

                    @if ($competition->limit == 0)
                        <input type="hidden" name="limit_exceeded" value="true">
                    @endif

                    <div class="form-group {{ Session::has('error') && Session::get('error')->has('nicks') ? 'has-error' : '' }}">
                        <label for="nicks" class="control-label">Nickname Profissional</label>
                        <input type="text" name="nicks[{{ $competitionId }}][]" class="form-control">
                        @if (Session::has('error') && Session::get('error')->has('nicks'))
                            <p class="text-danger">{{ Session::get('error')->get('nicks')[0] }}</p>
                        @endif
                    </div>
                    <input type="hidden", name="competitions[]" value="{{ $competitionId }}">
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-success-embeded">Registrar-se</button>
                </div>

            </div>
        </div>

        {!! Form::close() !!}

    </div>

@stop