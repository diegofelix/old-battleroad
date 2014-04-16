@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Campeonatos
                    @if (Auth::user() && Auth::user()->championships()->count())
                        {{ link_to_route('admin.championships.index', 'Meus Campeonatos', null, ['class' => 'btn btn-default manage-button pull-right']) }}
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
                        <div class="champ-inner">
                            <figure>
                                {{ HTML::image($champ->image, $champ->title, ['class' => 'img-responsive']) }}
                            </figure>
                            <section class="description">
                                <h3>{{ $champ->name }}</h3>
                                <p>{{ $champ->short_description }}</p>
                            </section>
                            <section class="info">
                                <a href="#" class="time-left">
                                    {{ $champ->days_left }}
                                </a>
                                <a href="#" class="price">
                                    <span>R$ {{ $champ->price }}</span>
                                    Entrada
                                </a>
                            </section>
                        </div><!-- champ-inner -->
                    </div><!-- champ -->
                @endforeach
            @endif
        </div><!-- container -->
    </div><!-- championship -->

@endsection