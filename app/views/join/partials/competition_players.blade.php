<p class="help-block">
    Essa competição pede que você adicione os jogadores do seu time para participar do campeonato.
</p>
@for ( $i = 1 ; $i <= $competition->players ; $i++)
    <div class="form-group">
        {{ Form::text("nicks[{$competition->id}][]", null, ['class' => 'form-control input-lg', 'placeholder' => "#$i Nick"]) }}
    </div>
@endfor