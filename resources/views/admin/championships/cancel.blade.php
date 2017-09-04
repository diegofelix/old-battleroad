@extends ('layouts.admin_championship')
@section ('champ-content')

    <h3>Cancelar um campeonato</h3>

    <p>Antes de cancelar o campeonato, precisamos analisar algumas variáveis, como: Quão próximo do evento está? Quantas pessoas já estão participando? Você já recebeu o dinheiro.</p>
    <p>Envie um e-mail para <a href="mailto:cancelar@battleroad.com.br">cancelar@battleroad.com.br</a> com o código do seu campeonato <strong>( ID: {{ $championship->id }} )</strong> e o <strong>e-mail bcash</strong> que você utiliza para que possamos realizar uma análise prévia e, estando tudo ok, cancelaremos o seu campeonato e devolveremos o dinheiro aos participantes.</p>
    <p>Caso haja algum problema, entraremos em contato com você.</p>

@stop