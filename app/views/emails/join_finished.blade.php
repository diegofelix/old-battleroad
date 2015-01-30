<html>
<body>
    <p>Olá <strong>Admin,</strong></p>

    <ul>
    @foreach ($cancelledJoins as $id)
        <li>{{ $id }}</li>
    @endforeach
    </ul>

</body>
</html>