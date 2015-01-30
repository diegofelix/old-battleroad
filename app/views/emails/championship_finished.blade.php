<html>
<body>
    <p>Olá <strong>Admin,</strong></p>

    <p>Um novo campeonato foi publicado, {{ link_to_route('dá uma olhada', 'championships.show', [$championship->id]) }}</p>
</body>
</html>