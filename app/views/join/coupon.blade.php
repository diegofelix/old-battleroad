<div class="panel panel-default">
    <div class="panel-heading"><span class="fa fa-ticket"></span> Cupom de desconto</div>
    <div class="panel-body">
        <p>Tem um Cupom de desconto? Adicione ao seu pagamento!</p>
        {{ Form::open(['route' => ['join.coupon', $join->id], 'method' => 'PATCH', 'class' => 'form-inline']) }}
            {{ Form::text('code', null, ['class' => 'form-control input-lg']) }}
            {{ Form::submit('Aplicar Desconto', ['class' => 'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
    </div>
</div>