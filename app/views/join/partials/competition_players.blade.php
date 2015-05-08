<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title"><small>Nick para: </small>{{ $competition->game->name }}</h3></div>
    <div class="panel-body">
        @for ( $i = 1 ; $i <= $competition->players ; $i++)
            <div class="form-group">
                {{ Form::text('nick', null, ['class' => 'form-control input-lg', 'placeholder' => "#$i Nick"]) }}
            </div>
        @endfor
    </div>
</div>