<div class="panel panel-default">
    <div class="panel-heading">Nick para o campeonato</div>
    <div class="panel-body">
        <div class="row">
            @foreach ($championship->competitions as $competition)
                <div class="col-md-3">
                    <h3>Campeonato</h3>
                    @for ( $i = 1 ; $i <= $competition->players ; $i++)
                        <div class="form-group">
                            {!! Form::text('nick', Auth::user()->username, ['class' => 'form-control input-lg']) !!}
                        </div>
                    @endfor
                </div>
            @endforeach
        </div>
    </div>
    <div class="panel-footer">
        Esse nome será exibido nas chaves do campeonato.<br>
        Se for um campeonato Online, coloque a gamertag da plataforma ( PSN/Live e etc )
    </div>
</div>