<nav class="navbar navbar-inverse logged" role="navigation">
    <div class="container wow bounceInDown">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{ link_to('/', 'BattleRoad', ['class' => 'navbar-brand']) }}
        </div> <!-- navbar-header -->

        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav">
                    <li>{{ link_to('championships', 'Campeonatos') }}</li>
                    <li>{{ link_to('http://battleroad.uservoice.com/knowledgebase', 'Como funciona?') }}</li>
                    <li><a href="http://battleroad.uservoice.com">Feedback</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::user()->isOrganizer())
                    <li><a href="{{ route('admin.dashboard') }}"><i class="icon icon-tachometer"></i> Dashboard</a></li>
                @else
                    <li><a href="{{ route('admin.joins') }}"><i class="icon icon-trophy"></i> Minhas inscrições</a></li>
                @endif
                <li id="user-options" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {{ HTML::image(Auth::user()->present()->userImage, Auth::user()->name, ['width' => '25']) }}
                        {{{ Auth::user()->name }}}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons" role="menu">
                        <li><a href="{{ route('profile.show', [Auth::user()->username]) }}"><i class="icon icon-user"></i> Perfil</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.joins') }}"><i class="icon icon-trophy"></i> Minhas inscrições</a></li>
                        <li><a href="{{ route('session.destroy') }}"><i class="icon icon-sign-out"></i> Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div> <!-- collapse -->
    </div> <!-- container -->
</nav>