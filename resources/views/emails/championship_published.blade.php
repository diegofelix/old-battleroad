<html>
<body>
    <p>Olá <strong>Admin,</strong></p>

    <p>Um novo campeonato foi publicado, {!! link_to_route('championships.show', 'dá uma olhada', [$championship->id]) !!}</p>
</body>
</html>