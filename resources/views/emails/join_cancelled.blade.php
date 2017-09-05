<html>
<body>
    <p>Olá <strong>{{ $name }},</strong></p>
    <p>Sua inscrição para o campeonato: <strong>{{ $championship }}</strong> foi cancelada.</p>
    <p>Isso pode ter ocorrido por você selecionar um pagamento e não ter pago em tempo hábil ou outros problemas com o pagamento.</p>
    <p>A vaga reservada para você no campeonato foi cancelada e o seu dinheiro será devolvido.</p>
    <p>Você pode {!! link_to_route('join.create', 'realizar novamente sua inscrição aqui', [$championship]) !!}</p>

    <p>Qualquer dúvida, entre em contato conosco através do e-mail: contato@battleroad.com.br</p>
</body>
</html>