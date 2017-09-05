<?php $joins = $championship->getFeaturedCompetitors($perPage); ?>
@if ($joins->count())
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Quem vai?</div>
            <table class="table table-bordered">
                @foreach ($joins as $join)
                    <tr>
                        <td>{!! link_to_route('profile.show', $join->present()->competitorName, [$join->user->username]) !!}</td>
                    </tr>
                @endforeach
            </table>
            @if ($joins->getTotal() > $perPage)
                <div class="panel-footer">
                    +{{ $joins->getTotal() - $perPage }} competidor(es).
                </div>
            @endif
        </div>
    </div>
@endif