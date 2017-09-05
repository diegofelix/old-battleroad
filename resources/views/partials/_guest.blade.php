<nav class="navbar navbar-inverse" role="navigation">
    <div class="container wow bounceInDown">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="/" class="navbar-brand">Battleroad <small class="beta">beta</small></a>
        </div> <!-- navbar-header -->

        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav">
                <li>{!! link_to_route('championships.index', 'Campeonatos') !!}</li>
                <li>{!! link_to_route('how_it_works', 'Como funciona?') !!}</li>
                <li>{!! link_to('http://battleroad.uservoice.com', 'Feedback') !!}</li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>{!! link_to_route('register.index', 'Cadastrar-se') !!}</li>
                <li>{!! icon_route('session.create', 'Login', 'sign-in') !!}</li>
            </ul>
        </div> <!-- collapse -->
    </div> <!-- container -->
</nav>