@extends('layouts.default')
@section('content')

    <div class="featured-title">
        <div class="container" id="how_it_works">
            <h2 class="wow fadeInLeft">Como funciona para o Jogador?</h2>
        </div>
    </div>

    <div class="container how-it-works" id="how-player">

        <h3>Quais as vantagens de participar de um campeonato por aqui?</h3>

        <p>Você fará parte da maior rede de campeonatos do Brasil, sempre que surgir um campeonato de seu interesse, você receberá um e-mail avisando o dia e hora do evento. Você poderá escolher a forma de pagamento e até parcelar a sua entrada, temos boleto, cartão de crédito, débito e muito mais. Além disso, estamos preparando muita novidade, <a href="">dá só uma olhada.</a></p>

        <h3>Quais jogos estão disponíveis?</h3>

        <p>Antes de inserirmos um jogo, precisamos saber como é o modelo no qual esse jogo se encaixa. Cada jogo tem um padrão e pra isso, precisamos analisar todas as vertentes antes de adicionar um jogo à plataforma, Por exemplo: Street Fighter é 1x1, já league of legends é 4x4. Estamos trabalhando duro para atender ao máximo de jogos possíveis.</p>

        <h3>Posso cancelar minha inscrição no campeonato?</h3>

        <p>Sim. Vá para a página do bcash, realize o login e cancele a transação por lá, seu dinheiro será estornado para sua conta bcash ou pro seu cartão, dependendo da forma de pagamento.</p>
        <p><strong>ATENÇÃO:</strong> Você só pode cancelar um campeonato 3 dias antes do início do mesmo, isso porque, a partir desse dia, o organizador estará contando com esse dinheiro.</p>

        <div class="row">
            <div class="col-md-7">
                {{ HTML::image('images/hiw_championship.png', '', ['class' => 'img-responsive']) }}
            </div>
            <div class="col-md-5">
                <h3>Participando de um campeonato</h3>
                <p>Após selecionar o campeonato desejado na lista de campeonatos, você será redirecionado para a página do campeonato. Lá você pode ver as informações detalhadas do campeonato, como preço de participação e etc.</p>
                <p>Após entender o funcionamento do campeonato, você pode clicar em participar.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <h3>Selecionando os jogos</h3>
                <p>Alguns campeonatos disponibilizam mais de um jogo para participar, esses jogos podem estar em datas diferentes do início do campeonato, por isso, fique atento às datas.</p>
                <p>Selecione quais competições você quer se inscrever, isso atualizará o preço total da participação. Após, confirme sua inscrição.</p>
            </div>
            <div class="col-md-7">
                {{ HTML::image('images/hiw_games.png', '', ['class' => 'img-responsive']) }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                {{ HTML::image('images/hiw_payment.png', '', ['class' => 'img-responsive']) }}
            </div>
            <div class="col-md-5">
                <h3>Realizando o pagamento</h3>
                <p>Sua vaga já está reservada, porém ainda não há garantias de que você vá participar, para confirmar sua participação, é preciso que você realize o pagamento, dependendo da forma de pagamento, a sua inscrição será confirmada, normalmente em questão de horas se for cartão ou débito, e 2 dias se for depósito ou boleto.</p>
                <p><strong>Atenção: </strong> Não deixe para pagar de última hora, pois pagamentos que demoram até 2 dias para serem compensados poderá inviabilizar sua participação. É recomendado que você pague imediatamente após a inscrição, para garantir que tudo ocorra dentro do prazo.</p>
            </div>
        </div>

        <p>Assim que o pagamento for confirmado, você receberá um e-mail e automaticamente você estará participando do campeonato.</p>

        <p>Ainda tem dúvidas? <a href="#">Entre no nosso canal de suporte.</a></p>

    </div>

@stop