@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="fa fa-ticket"></i> Cupons <small>Adicione cupons de descontos</small>
    </h3>

    {{ Form::open(['route' => ['admin.championships.coupons.generate', $championship->id], 'role' => 'form', 'class' => 'form-inline']) }}

        <div class="form-group">
            <label class="sr-only" for="percentage">Porcentagem</label>
            <div class="input-group ">
                <div class="input-group-addon">R$</div>
                {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price']) }}
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Gerar Cupon</button>

    {{ Form::close() }}

    <hr>

    <div class="panel panel-default">
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
                    <tr @if ($coupon->user) class="success" @endif>
                        <td><input type="text" class="form-control" value="{{ $coupon->code }}" readonly></td>
                        <td>@if($coupon->user) {{ $coupon->user->name }} @endif</td>
                        <td>{{ $coupon->present()->userPrice }}</td>
                        <td>{{ $coupon->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('scripts')
    {{ HTML::script('js/register.js') }}
@stop