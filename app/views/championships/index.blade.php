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
                        {{ link_to_route('admin.championships.create', 'Criar um Campeonato', null, ['class' => 'btn btn-default create-button pull-right']) }}
                    @endif
                </h2>
            </div>
        </div>

        <div class="container">
            @if (count($championships))
                @foreach ($championships as $champ)
                    <div class="champ col-md-3">
                        <a href="{{ route('championships.show', [$champ->id]) }}">
                            <div class="champ-inner">
                                <figure>
                                    {{ HTML::image($champ->thumb, $champ->title, ['class' => 'img-responsive']) }}
                                </figure>
                                <section class="description">
                                    <h3>{{ $champ->name }}</h3>
                                    <p>{{ $champ->short_description }}</p>
                                </section>
                                <section class="info">
                                    <a href="#" class="time-left">
                                        <i class="icon icon-calendar"></i> {{ $champ->days_left }}
                                    </a>
                                    <a href="#" class="price">
                                        <i class="icon icon-money"></i> {{ $champ->price }}
                                    </a>
                                </section>
                            </div><!-- champ-inner -->
                        </a>
                    </div><!-- champ -->
                @endforeach
            @endif
        </div><!-- container -->
    </div><!-- championship -->

@endsection