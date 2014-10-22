<form name="bcash"action="https://www.bcash.com.br/checkout/pay/"method="post">

    {{-- Organizer identifier --}}
    {{ Form::hidden('email_loja', $join->championship->refresh_token) }}

    {{-- Championship data --}}
    @foreach ($join->items as $key => $item)
        <?php $count = $key+1; ?>
        {{ Form::hidden('produto_codigo_'.$count, $item->id) }}
        {{ Form::hidden('produto_descricao_'.$count, 'Inscrição: ' . $item->competition->game->name ) }}
        {{ Form::hidden('produto_qtde_'.$count, 1) }}
        {{ Form::hidden('produto_valor_'.$count, $item->price) }}
    @endforeach
    {{-- // Championship data --}}

    <input name="email"type="hidden" value="{{{ $join->user->email }}}">
    <input name="nome"type="hidden"value="{{{ $join->user->name }}}">

    {{-- Comission data --}}
    {{ Form::hidden('email_dependente_1', 'diegoflx.oliveira@gmail.com') }}
    {{ Form::hidden('valor_dependente_1', 0.25) }}
    {{-- // Comission data --}}

    {{-- Urls --}}
    {{ Form::hidden('url_retorno', route('join.returned', $join->id)) }}
    {{ Form::hidden('url_aviso', route('bcash')) }}
    {{-- // Urls --}}

    {{ Form::submit('Realizar Pagamento', ['class' => 'btn btn-lg btn-success']) }}

</form>