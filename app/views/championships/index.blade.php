@extends ('layouts.default')

@section ('content')

    <div id="championship" class="main-container">
        <div class="container">
            {{-- <h2 class="main-title">Campeonatos <a href="#" class="pull-right"><!-- <span class="fa fa-search"></span> --></a></h2> --}}
            <div class="row">
                <div class="col-md-9">
                    @if (count($championships))
                        @foreach ($championships as $champ)
			@if ($champ->id != 40)
                            <div class="panel panel-default champ-item">
                                <div class="panel-heading">
                                    <a href="{{ route('championships.show', $champ->id) }}">
                                        {{ $champ->name }} <span class="pull-right">{{ $champ->present()->countCompetitions() }}</span></div>
                                    </a>
                                <div class="panel-body">
                                    <a href="{{ route('championships.show', $champ->id) }}">
                                        <figure>
                                            {{ HTML::image($champ->image, $champ->title, ['class' => 'img-responsive']) }}
                                        </figure>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    <a href="#" class="time-left">
                                        <i class="fa fa-calendar"></i> {{ $champ->present()->daysLeft }}
                                    </a>
                                    <a href="#" class="price pull-right">
                                        <strong>{{ $champ->present()->lowestPrice }}</strong>
                                    </a>
                                </div>
                            </div>
			@endif
                        @endforeach
                    @endif
                </div>
                <div class="col-md-3">
                    <div id="filters" class="panel panel-default">
                        <div class="panel-heading">Filtrar por Jogo</div>
                        <ul class="list-group">
                            @include('championships.partials.filters')
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div><!-- championship -->

@endsection
