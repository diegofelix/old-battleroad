<fieldset>

    <legend><span class="fa fa-user"></span> Dados Pessoais</legend>

    <div class="form-group">
        {{ Form::label('bio', 'Biografia: ', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-7">
            {{ Form::textarea('bio', null, [
                'class' => 'form-control',
                'id' => 'bio',
                'placeholder' => 'Fale um pouco sobre você...',
                'rows' => '10',
                'cols' => '10'
            ]) }}
        </div>
    </div>
<!--
    <div class="form-group">
        {{ Form::label('phone', 'Telefone: ', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-7">
            {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'required']) }}
        </div>
    </div> -->

</fieldset>

<fieldset>

    <legend><span class="fa fa-gamepad"></span> Gamer Tags</legend>

    <div class="form-group">
        {{ Form::label('psn', 'PSN: ', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-7">
            {{ Form::text('psn', null, ['class' => 'form-control', 'id' => 'psn']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('live', 'Xbox live: ', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-7">
            {{ Form::text('live', null, ['class' => 'form-control', 'id' => 'live']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('steam', 'Steam: ', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-7">
            {{ Form::text('steam', null, ['class' => 'form-control', 'id' => 'live']) }}
        </div>
    </div>

</fieldset>
<fieldset>

    <legend><span class="fa fa-check"></span> Notificações</legend>

    <div class="form-group">
        <div class="col-md-7 col-md-offset-2">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('notify') }} Receber mensalmente novidades da Battleroad.
                </label>
            </div>
        </div>
    </div>

    <!-- <legend>Para organizadores</legend>


    <div class="form-group">
        {{ Form::label('moip_user', 'Login MOIP: ', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-7">
            {{ Form::text('moip_user', null, ['class' => 'form-control', 'id' => 'moip_user']) }}
            <div class="help-block">
                <p>Uma conta MOIP é necessária caso você vá organizar campeonatos.<br>
                <a href="#">Veja como criar uma conta MOIP aqui</a></p>
            </div>
        </div>
    </div> -->

</fieldset>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success champ-button">Salvar</button>
    </div>
</div>