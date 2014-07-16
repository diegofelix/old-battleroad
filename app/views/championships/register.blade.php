@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                {{ HTML::image($championship->image) }}
            </div>
        </div>

        {{ Form::open(['route' => 'championships.payment']) }}

            {{ Form::hidden('id', $championship->id) }}

            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Preço (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" value="1" checked="checked" readonly="readonly" /> Entrada</td>
                            <td>{{ $championship->price }}</td>
                        </tr>
                        @foreach ($championship->competitions as $competition)
                            <?php

                                $total = $championship->price;

                                if ( ! empty($competitions) && in_array($competition->id, $competitions))
                                {
                                    $total += $competition->price;
                                }

                            ?>
                            <tr>
                                <td><input type="checkbox" name="competitions[]" value="{{ $competition->game_id }}" /> {{ $competition->game->name }}</td>
                                <td>{{ $competition->price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th><span class="pull-right">Total</span></th>
                            <th>{{ $total }}</th>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-lg btn-success">Finalizar Inscrição</button>

            </div>
        {{ Form::close() }}

    </div><!-- championship -->

@endsection