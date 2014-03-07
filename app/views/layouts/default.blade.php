<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="O primeiro site de campeonatos do brasil!">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Champaholic - De olho nos campeões</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

        {{ HTML::style('css/main.css') }}
    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
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

            <div class="piece banner">
                
                <div id="call-subscribe">
                    <header>
                        <h1><a href="#">Champaholic</a></h1>
                    </header>
                    <section>
                        <p>A primeira plataforma de campeonatos do Brasil. Mostre quem é o melhor!</p>
                        <p><a href="#" title="Cadastre-se" class="btn button-subscribe">Cadastre-se!</a></p>
                    </section>
                </div>

            </div>

        </div><!-- wrapper -->
    </body>
</html>