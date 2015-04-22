@extends ('layouts.admin_championship')
@section ('champ-content')
    @if ($join && $transaction)

        <h3><i class="fa fa-money"></i>
            Transação #{{ $transaction->transactionId }}
        </h3>

        <div class="panel panel-default">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Competidor</th>
                        <td>{{ $join->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Nick</th>
                        <td>{{ $join->user->username }}</td>
                    </tr>
		    <tr>
			<th>E-mail</th>
			<td>{{ $join->user->email }}</th>
		    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Informações sobre a transação</div>
            <table class="table table-striped table-hover games-table">
                    <tr>
                        <th>ID da Transação</th>
                        <td>{{ $transaction->transactionId }}</td>
                    </tr>
                    <tr>
                        <th>ID da Inscrição</th>
                        <td>{{ $join->id }}</td>
                    </tr>
                    <tr>
                        <th>Data efetuada</th>
                        <td>{{ $transaction->transactionDate }}</td>
                    </tr>
                    <tr>
                        <th>Data de crédito</th>
                        <td>{{ $transaction->creditDate }}</td>
                    </tr>
                    <tr>
                        <th>Preço Original</th>
                        <td>{{ $transaction->originalPrice }}</td>
                    </tr>
                    <tr>
                        <th>Método de pagamento</th>
                        <td>{{ $transaction->paymentMethod }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $transaction->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning">Ainda não há dados para essa transação.</div>
    @endif
@stop
