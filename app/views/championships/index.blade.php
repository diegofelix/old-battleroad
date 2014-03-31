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
                @foreach ($championships as $key => $champ)
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
                        <div class="champ col-md-4">
                            <figure>
                                {{ HTML::image($champ->image, $champ->title, ['class' => 'img-responsive']) }}
                            </figure>
                            <h3>{{ $champ->description }}</h3>
                        </div>
                    @endif
                @endforeach
                </div><!-- other champs -->
            @endif
        </div><!-- container -->
    </div><!-- championship -->

@endsection