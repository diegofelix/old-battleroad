<nav class="navbar navbar-inverse logged" role="navigation">
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
                    <li>{!! link_to('championships', 'Campeonatos') !!}</li>
                    <li>{!! link_to_route('how_it_works', 'Como funciona?') !!}</li>
                    <li><a href="http://battleroad.uservoice.com">Feedback</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::user()->isOrganizer())
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                @else
                    <li><a href="{{ route('admin.joins') }}"><i class="fa fa-trophy"></i> Minhas inscrições</a></li>
                @endif
                <li id="user-options" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {!! HTML::image(Auth::user()->present()->userImage, Auth::user()->name, ['width' => '25']) !!}
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons" role="menu">
                        <li><a href="{{ route('profile.show', [Auth::user()->username]) }}"><i class="fa fa-user"></i> Perfil</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.joins') }}"><i class="fa fa-trophy"></i> Minhas inscrições</a></li>
                        <li><a href="{{ route('session.destroy') }}"><i class="fa fa-sign-out"></i> Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div> <!-- collapse -->
    </div> <!-- container -->
</nav>