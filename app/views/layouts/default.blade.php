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

            <div class="banner">

                <div class="container">

                    <hgroup>
                        <h2>De olho nos campeões</h2>
                        <h3>Dedicado aos <span class="highlight">jogadores.</span></h3>
                        <h3>Perfeito para <span class="highlight">Lan Houses & Organizadores.</span></h3>
                    </hgroup>

                </div>

                <div class="subscription">
                    <div class="container">
                        <div class="subscribe">
                            <a class="btn btn-lg btn-default btn-subscribe" href="#">Cadastre-se, é grátis!</a>
                        </div>
                    </div>
                </div>

            </div>

            <div id="content" class="piece second">

                <div class="container">

                    <h2>Se preocupe com o campeonato, nós cuidamos dos jogadores!</h2>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Crie seu campeonato e a Champaholics cuidará do resto: Divulgação, inscrição, pagamento e etc.</p>
                            <p><a class="btn btn-warning btn-lg" href="#">Saiba mais</a></p>
                        </div>

                        <div class="col-md-8">
                            <img class="img-responsive" src="http://placehold.it/700x500" alt="">
                        </div>
                    </div>

                </div>

            </div>

            <div class="piece third">

                <div class="container">

                    <h2>É fanático por games e competição? Está no lugar certo!</h2>

                    <div class="row">
                        <div class="col-md-8">
                            <img class="img-responsive" src="http://placehold.it/700x500" alt="">
                        </div>

                        <div class="col-md-4">
                            <p>Faça amigos, participe de campeonatos, ganhe prêmios, seja reconhecido, seja o melhor!</p>
                            <p><a class="btn btn-warning btn-lg" href="#">Saiba mais</a></p>
                        </div>
                    </div>
                </div>
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
    </body>
</html>