<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container wow bounceInDown">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{ link_to('/', 'Champaholic', ['class' => 'navbar-brand']) }}
        </div> <!-- navbar-header -->

        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav">
                <li>{{ link_to_route('home.how_it_works', 'Como funciona?') }}</li>
                <li><a href="#">Feedback</a></li>
                <li><a href="#">Ajuda</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li id="user-options" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {{ HTML::image(Auth::user()->picture, Auth::user()->name, ['width' => '30']) }}
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons">
                        <li>
                            <a href="/all">
                                <i class="icon-pencil"></i>
                                Perfil
                            </a>
                        </li>
                        <li>
                            <a href="/all">
                                <i class="icon-signout"></i>
                                Sair
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div> <!-- collapse -->
    </div> <!-- container -->
</nav>