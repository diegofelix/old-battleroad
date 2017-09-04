<html>
<body>
    <p>Olá <strong>{{ $name }},</strong></p>
    <p>Agora você está participando do campeonato: <strong>{{ $championship }}</strong>.</p>
    <p>
        Lembrando que você tem 2 dias para pagar o campeonato, caso contrário, sua inscrição será cancelada e a vaga liberada. <br>
        Caso já tenha efetuado o pagamento, desconsidere esse e-mail.
    </p>
    <p>O número da sua inscrição é: <strong>{{ $join }}</strong></p>

    <p>Para mais informações, acesse: {{ link_to_route('join.show', 'a página do seu pedido', $join) }}</p>
</body>
</html>