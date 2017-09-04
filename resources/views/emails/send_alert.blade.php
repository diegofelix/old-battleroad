<html>
<body>
    <p>Olá <strong>{{ $name }},</strong></p>
    <p>O campeonato que você está inscrito começará daqui 3 dias, garanta já sua vaga realizando o pagamento agora!</p>
    <p>Pagamentos como Boleto e Depósito, por exemplo, demoram até 3 dias úteis para serem confirmados.</p>
    <p>Deixando para pagar no dia do campeonato, você correrá o risco de perder a vaga.</p>
    <p>{{ link_to_route('join.show', 'Clique aqui', $join->id)}} para realizar o pagamento.</p>
</body>
</html>