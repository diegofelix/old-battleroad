<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="O primeiro site de campeonatos do brasil!">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>BattleRoad - De olho nos campeões</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,900' rel='stylesheet' type='text/css'>

        {{ HTML::style('css/main.css') }}

    </head>

    <body>

        <div id="wrapper">

            @include ('partials._flash_message')

            @if (Auth::user())
                @include ('partials._logged')
            @else
                @include ('partials._guest')
            @endif

            <div id="content">
                @yield('content')
            </div>

            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Plataforma</h4>
                            <ul>
                                <li><a href="#">Como funciona?</a></li>
                                <li><a href="#">Sobre</a></li>
                                <li><a href="#">Changelog</a></li>
                                <li><a href="#">Ajuda</a></li>
                                <!--<li><a href="#">Estatísticas</a></li>-->
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Colabore</h4>
                            <ul>
                                <li><a href="#">Feedback</a></li>
                                <li><a href="#">Depoimentos</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Onde estamos?</h4>
                            <ul>
                                <li><a href="mailto:contato@BattleRoad.com.br"><span class="icon-mail"></span>E-mail</a></li>
                                <li><a href="#"><span class="icon-twitter"></span> Twitter</a></li>
                                <li><a href="#"><span class="icon-facebook"></span> Facebook</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="rights">
                        BattleRoad {{ date('Y')}} - Todos os direitos reservados.
                    </div>
                </div>
            </footer>
        </div><!-- wrapper -->
    {{ HTML::script('js/lib/jquery.min.js') }}
    {{ HTML::script('js/lib/bootstrap.min.js') }}
    {{ HTML::script('js/lib/wow.min.js') }}
    <script>
        new WOW().init();
    </script>
    </body>
</html>