@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="fa fa-ticket"></i> Cupons <small>Adicione cupons de descontos</small>
    </h3>

    {{ Form::open(['route' => ['admin.championships.coupons.generate', $championship->id], 'role' => 'form']) }}

        <input type="text" name="price" class="form-control">
        <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Gerar Cupon</button>

    {{ Form::close() }}

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Usuário</th>
                <th>Valor</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->coupons as $coupon)
                <tr>
                    <td><input type="text" class="form-control" value="{{ $coupon->code }}" readonly></td>
                    <td>@if(isset($coupon->user)) {{ $coupon->user->name }} @endif</td>
                    <td>{{ $coupon->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop