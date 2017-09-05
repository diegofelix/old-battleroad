<p class="help-block">
    Essa competição pede que você adicione os jogadores do seu time para participar do campeonato.
</p>
<p>Nome do time</p>
<div class="form-group">
    {!! Form::text("team_name", null, ['class' => 'form-control input-lg', 'placeholder' => 'Nome do Time']) !!}
</div>

<p>Membros</p>

@for ( $i = 1 ; $i <= $competition->players ; $i++)
    <div class="form-group">
        {!! Form::text("nicks[{$competition->id}][]", null, ['class' => 'form-control input-lg', 'placeholder' => "#$!! Nick"]) }}
    </div>
@endfor