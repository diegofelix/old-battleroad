<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Resetar Senha</h2>

		<div>
            <p>Olá, recemos um pedido para resetar sua senha, caso tenha sido feito por você, clique no link abaixo.</p>
            <p>Do contrário, desconsidere esse e-mail.</p>
			<p>{{ URL::to('password/reset', array($token)) }}</p>
		</div>
	</body>
</html>