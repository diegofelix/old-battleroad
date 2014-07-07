@extends ('layouts.default')

@section ('content')

    <div id="championship_register">

         <div class="featured-title championship">
            <div class="container">
                <h2>Crie seu campeonato</h2>
            </div>
        </div>

        <div class="container">

            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="@if(Request::segment(4) == '') active @else disabled @endif"><a href="#step-1">
                    <h4 class="list-group-item-heading">Informações</h4>
                    <p class="list-group-item-text">Como vai ser o campeonato?</p>
                </a></li>
                <li class="@if(Request::segment(4) == 'location') active @else disabled @endif"><a href="#step-2">
                    <h4 class="list-group-item-heading">Localização</h4>
                    <p class="list-group-item-text">Onde será feito?</p>
                </a></li>
                <li class="@if(Request::segment(4) == 'games') active @else disabled @endif"><a href="#step-3">
                    <h4 class="list-group-item-heading">Jogos</h4>
                    <p class="list-group-item-text">Quais os jogos?</p>
                </a></li>
                <li class="@if(Request::segment(4) == 'confirmation') active @else disabled @endif"><a href="#step-3">
                    <h4 class="list-group-item-heading">Confirmação</h4>
                    <p class="list-group-item-text">Tudo certo?</p>
                </a></li>
            </ul>

            @yield('register_content')

        </div>

    </div><!-- championship -->

@endsection