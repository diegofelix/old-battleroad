<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="@yield('meta_description', 'O primeiro site de campeonatos do brasil!')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="google-site-verification" content="QlRQqaIL0xz5aGS-ZENdKQKdTNaUQfiphyBgVJV_-u4" />

        <title>Battleroad - @yield('title', 'De olho nos campeões')</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" >

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
                                <li>{{ link_to_route('how_it_works', 'Como funciona?') }}</li>
                                <!-- <li><a href="#">Sobre</a></li> -->
                                <!-- <li><a href="#">Changelog</a></li> -->
                                <!--<li><a href="#">Estatísticas</a></li>-->
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Colabore</h4>
                            <ul>
                                <li><a href="http://battleroad.uservoice.com">Feedback</a></li>
                                <!-- <li><a href="#">Depoimentos</a></li> -->
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Onde estamos?</h4>
                            <ul>
                                <li><a href="mailto:contato@battleroad.com.br"><span class="fa fa-envelope"></span> E-mail</a></li>
                                <li><a href="http://twitter.com/sigabattleroad"><span class="fa fa-twitter-square"></span> Twitter</a></li>
                                <li><a href="https://www.facebook.com/battleroadoficial"><span class="fa fa-facebook-square"></span> Facebook</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="rights">
                        BattleRoad {{ date('Y')}} - Todos os direitos reservados.
                    </div>
                </div>
            </footer>
        </div><!-- wrapper -->
    {{ HTML::script('js/min.js') }}
    <script>
        new WOW().init();
    </script>
    @yield('scripts')
    </body>
</html>
