<html>
<body>
    <p>Olá <strong>Diego Felix,</strong></p>

    <ul>
    @foreach ($cancellesJoins as $id)
        <li>{{ $id }}</li>
    @endforeach
    </ul>

</body>
</html>