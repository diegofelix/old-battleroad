<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="O primeiro site de campeonatos do brasil!">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Champaholic - De olho nos campeões</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,900' rel='stylesheet' type='text/css'>

        {{ HTML::style('css/main.css') }}
    </head>

    <body>

        <div id="wrapper">

            @include('partials._flash_message')

            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="#">Champaholic</a>
                    </div> <!-- navbar-header -->

                    <div class="collapse navbar-collapse navbar-ex1-collapse">

                        <ul class="nav navbar-nav">
                            <li><a href="#">Como Funciona?</a></li>
                            <li><a href="#">Feedback</a></li>
                            <li><a href="#">Ajuda</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Login</a></li>
                        </ul>
                    </div> <!-- collapse -->
                </div> <!-- container -->
            </nav>

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
                                <li><a href="mailto:contato@champaholic.com.br"><span class="icon-mail"></span>E-mail</a></li>
                                <li><a href="#"><span class="icon-twitter"></span> Twitter</a></li>
                                <li><a href="#"><span class="icon-facebook"></span> Facebook</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="rights">
                        Champaholic {{ date('Y')}} - Todos os direitos reservados.
                    </div>
                </div>
            </footer>
        </div><!-- wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    {{ HTML::script('js/bootstrap.min.js') }}
    </body>
</html>