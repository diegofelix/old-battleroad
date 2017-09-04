@extends ('layouts.default')

@section ('content')

    <div id="championship">

        <div class="featured-title championship">
            <div class="container">
                <h2>
                    Meus Campeonatos
                    {{ link_to_route('admin.register.index', 'Criar um Campeonato', null, ['class' => 'btn btn-default create-button pull-right']) }}
                </h2>
            </div>
        </div>

        <div class="container">
            @if (count($championships))
                @foreach ($championships as $champ)
                    <div class="manage-champ">
                        <header>
                            <h2>
                                {{ $champ->name }}
                                {{ link_to_route('admin.championships.show',  'Gerenciar', [$champ->id], ['class' => 'btn btn-default manage-button pull-right'])  }}
                            </h2>
                        </header>
                        <section class="champ-infos">
                            <div class="info">
                                <strong>Preço: </strong>
                                {{ $champ->present()->userPrice }}
                            </div>
                        </section>
                    </div><!-- champ -->
                @endforeach
            @endif
        </div><!-- container -->
    </div><!-- championship -->

@endsection