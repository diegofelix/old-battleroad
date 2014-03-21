<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                <li>{{ link_to('http://battleroad.uservoice.com/knowledgebase', 'Como funciona?') }}</li>
                <li><a href="http://battleroad.uservoice.com">Feedback</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>{{ link_to_route('session.create', 'Login') }}</li>
            </ul>
        </div> <!-- collapse -->
    </div> <!-- container -->
</nav>