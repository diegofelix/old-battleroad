<form name="bcash"action="https://www.bcash.com.br/checkout/pay/"method="post">

    <input name="email"type="hidden" value="{{{ $join->user->email }}}">
    {{ Form::hidden('email_dependente_1', $join->championship->refresh_token) }}
    {{-- Organizer identifier --}}
    {{ Form::hidden('email_loja', 'diegoflx.oliveira@gmail.com') }}

    {{-- Join id --}}
    {{ Form::hidden('id_pedido', $join->id) }}
    <input name="nome"type="hidden"value="{{{ $join->user->name }}}">

    {{-- Championship data --}}
    @foreach ($join->items as $key => $item)
        <?php $count = $key+1; ?>
        {{ Form::hidden('produto_codigo_'.$count, $item->id) }}
        {{ Form::hidden('produto_descricao_'.$count, 'Inscrição: ' . $item->competition->game->name ) }}
        {{ Form::hidden('produto_qtde_'.$count, 1) }}
        {{ Form::hidden('produto_valor_'.$count, $item->price) }}
    @endforeach
    {{-- // Championship data --}}

    {{-- User data --}}
    {{-- // User data --}}

    {{-- Comission data --}}
    {{-- // Comission data --}}

    {{-- Urls --}}
    {{ Form::hidden('url_aviso', route('bcash')) }}
    {{ Form::hidden('url_retorno', route('join.returned', $join->id)) }}
    {{ Form::hidden('valor_dependente_1', $join->present()->totalPrice) }}
    {{-- // Urls --}}

    {{ Form::hidden('hash', $token) }}

    {{ Form::submit('Realizar Pagamento', ['class' => 'btn btn-lg btn-success']) }}

</form>