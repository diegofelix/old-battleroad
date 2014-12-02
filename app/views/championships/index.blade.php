@extends ('layouts.default')

@section ('content')

    <div id="championship" class="main-container">
        <div class="container">
            <h2 class="main-title">Campeonatos <a href="#" class="pull-right"><!-- <span class="fa fa-search"></span> --></a></h2>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @if (count($championships))
                            @foreach ($championships as $champ)
                                <div class="champ-item col-md-12">
                                    <a href="{{ route('championships.show', [$champ->id]) }}">
                                        <div class="champ-inner">
                                            <h3>{{ $champ->name }} <span>{{ $champ->present()->countCompetitions() }}</span></h3>
                                            <figure>
                                                {{ HTML::image($champ->image, $champ->title, ['class' => 'img-responsive']) }}
                                            </figure>
                                            <!--
                                            <div class="description">
                                                <p>{{ $champ->short_description }}</p>
                                            </div>
                                            -->
                                            <section class="info">
                                                <a href="#" class="time-left">
                                                    <i class="fa fa-calendar"></i> {{ $champ->present()->daysLeft }}
                                                </a>
                                                <a href="#" class="price">
                                                    <strong>{{ $champ->present()->lowestPrice }}</strong>
                                                </a>
                                            </section>
                                        </div><!-- champ-inner -->
                                    </a>
                                </div><!-- champ -->
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="champ-item col-md-3">
                    <div id="filters" class="champ-inner">
                        <h3>Filtrar por Jogo</h3>
                        <ul class="list-group">
                            @include('championships.partials.filters')
                        </ul>
                    </div><!-- champ-inner -->
                </div>
            </div>
        </div><!-- container -->
    </div><!-- championship -->

@endsection