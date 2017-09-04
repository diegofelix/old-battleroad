<div class="row">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-addon">R$</span>
            {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'data-rate' => Config::get('champ.rate'), 'placeholder' => 'Preço à Receber']) }}
        </div>
        <span class="help-block">Preço que você irá receber</span>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-addon">R$</span>
            {{ Form::text('preview', null, ['class' => 'form-control', 'id' => 'preview', 'placeholder' => 'Preço mostrado ao competidor', 'disabled' => 'disabled']) }}
        </div>
        <span class="help-block">Preço que o competidor irá pagar</span>
    </div>
</div>