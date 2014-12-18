<form name="bcash"action="https://www.bcash.com.br/checkout/pay/"method="post">

    {{-- Organizer identifier --}}
    {{ Form::hidden('email_loja', 'diegoflx.oliveira@gmail.com') }}

    {{-- Join id --}}
    {{ Form::hidden('id_pedido', $join->id) }}

    {{-- Championship data --}}
    @foreach ($join->items as $key => $item)
        <?php $count = $key+1; ?>
        {{ Form::hidden('produto_codigo_'.$count, $item->id) }}
        <input type="hidden" name="produto_descricao_{{$count}}" value="{{str_replace(' ', '', 'Inscrição: ' . $item->competition->game->name) }}">
        {{-- Form::hidden('produto_descricao_'.$count, str_replace(' ', '', 'Inscrição: ' . $item->competition->game->name )) --}}
        {{ Form::hidden('produto_qtde_'.$count, 1) }}
        {{ Form::hidden('produto_valor_'.$count, $item->price) }}
    @endforeach
    {{-- // Championship data --}}

    {{-- User data --}}
    <input name="email" type="hidden" value="{{ $join->user->email }}">
    <input name="nome" type="hidden" value="{{ str_replace(' ', '', $join->user->name) }}">
    {{-- // User data --}}

    {{-- Comission data --}}
    {{ Form::hidden('email_dependente_1', $join->championship->token) }}
    {{ Form::hidden('valor_dependente_1', $join->present()->totalPrice) }}
    {{-- // Comission data --}}

    {{-- Urls --}}
    {{ Form::hidden('url_retorno', route('join.returned', $join->id)) }}
    {{ Form::hidden('url_aviso', route('bcash')) }}
    {{-- // Urls --}}

    {{ Form::hidden('hash', $token) }}

    {{ Form::submit('Realizar Pagamento', ['class' => 'btn btn-lg btn-success']) }}

</form>