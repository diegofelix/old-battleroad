@extends ('layouts.default')

@section('content')

    <div class="banner">

        <div class="container">

            <hgroup>
                <h2 class="wow fadeInDown">De olho nos campeões</h2>
                <h3 class="wow fadeInUp">Dedicado aos <span class="highlight">jogadores.</span></h3>
                <h3 class="wow fadeInUp">Perfeito para <span class="highlight">Lan Houses & Organizadores.</span></h3>
            </hgroup>

        </div>

        <div class="subscription">
            <div class="container">
                <div class="subscribe">
                    {!! link_to_route('register.index', 'Cadastre-se, é grátis!', null, ['class' => 'btn btn-lg btn-default btn-subscribe']) !!}
                </div>
            </div>
        </div>

    </div>

    <div id="content" class="piece second">

        <div class="container">

            <h2>Se preocupe com o campeonato, nós cuidamos dos jogadores!</h2>

            <div class="row">
                <div class="col-md-4">
                    <p>Crie seu campeonato e a BattleRoad cuidará do resto: Divulgação, inscrição, pagamento e etc.</p>
                </div>

                <div class="col-md-8">
                    {!! HTML::image('images/admin.jpg', 'Painel de Administração', ['class' => 'img-responsive']) !!}
                </div>
            </div>

        </div>

    </div>

    <div class="piece third">

        <div class="container">

            <h2>É fanático por games e competição? Está no lugar certo!</h2>

            <div class="row">
                <div class="col-md-8">
                    {!! HTML::image('images/championships.jpg', 'Lista de campeonatos', ['class' => 'img-responsive']) !!}
                </div>

                <div class="col-md-4">
                    <p>Faça amigos, participe de campeonatos, ganhe prêmios, seja reconhecido, seja o melhor!</p>
                </div>
            </div>
        </div>
    </div>

@stop