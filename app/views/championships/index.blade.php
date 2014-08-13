@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Campeonatos
                    @if (Auth::user() && Auth::user()->championships()->count())
                        {{ link_to_route('admin.championships.index', 'Meus Campeonatos', null, ['class' => 'btn btn-default create-button pull-right']) }}
                    @else
                        {{ link_to_route('admin.register.index', 'Criar um Campeonato', null, ['class' => 'btn btn-default create-button pull-right']) }}
                    @endif
                </h2>
            </div>
        </div>

        <div class="container">
            <div class="col-md-9">
                <div class="row">
                    @if (count($championships))
                        @foreach ($championships as $champ)
                            <div class="champ col-md-12">
                                <a href="{{ route('championships.show', [$champ->id]) }}">
                                    <div class="champ-inner">
                                        <h3>{{ $champ->name }}</h3>
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
                                                <i class="icon icon-calendar"></i> {{ $champ->present()->daysLeft }}
                                            </a>
                                            <a href="#" class="price">
                                                <strong>{{ $champ->present()->userPrice }}</strong>
                                            </a>
                                        </section>
                                    </div><!-- champ-inner -->
                                </a>
                            </div><!-- champ -->
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="champ col-md-3">
                    <div class="champ-inner">
                        <h3>Filtros</h3>
                        <ul>
                            @include('championships.partials.filters')
                        </ul>
                    </div><!-- champ-inner -->
                </a>
            </div>
        </div><!-- container -->
    </div><!-- championship -->

@endsection