@extends ('layouts.default')

@section ('content')

    <div id="championship_register">

        <div class="container main-container">

            <ul id="steps">
                <li class="@if(Request::segment(4) == '') active @endif">
                    <span class="step">1</span>
                    <h4>
                        Informações
                        <small>Como vai ser?</small>
                    </h4>
                </li>
                <li class="@if(Request::segment(4) == 'location') active @endif">
                    <span class="step">2</span>
                    <h4>
                        Localização
                        <small>Onde vai ser?</small>
                    </h4>
                </li>

                <li class="@if(Request::segment(4) == 'games') active @endif">
                    <span class="step">3</span>
                    <h4>
                        Jogos
                        <small>Quais jogos?</small>
                    </h4>
                </li>
                <li class="@if(Request::segment(4) == 'confirmation') active @endif">
                    <span class="step">4</span>
                    <h4>
                        Confirmação
                        <small>Tudo certo?</small>
                    </h4>
                </li>
            </ul>


           <!--  <ul class="nav nav-pills nav-justified thumbnail setup-panel">
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
            </ul> -->

            @yield('register_content')

        </div>

    </div><!-- championship -->

@endsection