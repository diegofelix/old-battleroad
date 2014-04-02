@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Campeonatos
                    {{ link_to_route('championships.create', 'Criar um Campeonato', null, ['class' => 'btn btn-default create-button pull-right']) }}
                </h2>
            </div>
        </div>

        <div class="container">
            @if (count($championships))
                @foreach ($championships as $champ)
                    {{--
                    @if ($key == 0)
                    <div class="main-champ">
                        <figure>
                            {{ HTML::image($champ->image, $champ->title, ['class' => 'img-responsive']) }}
                            <figcaption>
                                <h2>{{ $champ->name }}</h2>
                                <p>{{ $champ->description }}</p>
                            </figcaption>
                        </figure>
                    </div><!-- main-champ -->
                    <!-- other champs -->
                    <div class="row">
                    @else
                    --}}
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
                            </div>
                        </div>
                    {{--@endif--}}
                @endforeach
                </div><!-- other champs -->
            @endif
        </div><!-- container -->
    </div><!-- championship -->

@endsection