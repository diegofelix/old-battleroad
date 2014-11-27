@extends('layouts.default')
@section('content')

    <div class="featured-title">
        <div class="container">
            <h2 class="wow fadeInLeft">Como funciona para o Organizador?</h2>
        </div>
    </div>
    <div class="container how-it-works" id="how-player">
        <h3>Primeiros passos</h3>
            <p>Nossa ferramenta foi criada pensando em facilitar a vida do organizador, que já tem que resolver problemas com patrocínio, premiação e etc. A Battleroad irá cuidar do pagamento pra você, com poucas informações você já está comseu campeonato criado.</p>
        <div class="row">
            <div class="col-md-7">
                {{ HTML::image('images/hiw_dashboard.png', '', ['class' => 'img-responsive']) }}
            </div>
            <div class="col-md-5">
                <h3>Dashboard</h3>
                <p>Seu Dashboard é sua página principal, é onde você poderá criar novos campeonatos e gerenciar os que você já criou. Todos os novos recursos que a Battleroad está preparando pra você apareceram automaticamente em seudashboard, por isso, fique ligado!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h3>Criando um campeonato</h3>
                <p>Em seu Dashboard haverá um botão para criar um novo campeonato, clicando nele você virá para essa página, essas informações iniciais são cruciais para a divulgação do seu campeonato. Escolha uma imagemchamativa para o campeonato, na página terá uma dica da melhor resolução para a battleroad.</p>
                <p>Você também precisa definir a data do campeonato. Essa data é muito importante, porque será baseada nela que definiremos a data de finalização dos pagamentos, por exemplo, se você disser que o campeonato começa no dia 10/01/2015, no dia 07/08/2015 enviaremos e-mails aos jogadores que se inscreveram mas ainda não pagaram o campeonato lembrando sobre o pagamento. Isso porque alguns tipos de pagamento necessitam de 2dias para confirmação, como boleto e depósito.</p>
            </div>
            <div class="col-md-7">
                {{ HTML::image('images/hiw_register.png', '', ['class' => 'img-responsive']) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                {{ HTML::image('images/hiw_games.png', '', ['class' => 'img-responsive']) }}
            </div>
            <div class="col-md-5">
                <h3>Adicionando jogos ao campeonato</h3>
                <p>Aqui é onde você irá adicionar os jogos que farão parte do seu campeonato. Quando formos divulgar seu campeonato aos jogadores vamos colocar o menor preço para que ele fique mais chamativo. Você poderá por um limite de participantes, ele irá ajudar a você não vender mais do que o seu local suporta, caso não hajalimites, não precisa preencher o campo.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h3>Integração com BCash</h3>
                <p>Para que possamos garantir a sua segurança e a de seus clientes, precisamos contar com um sistema de pagamentos que traga confiabilidade, ao mesmo tempo que atenda às nossas necessidades. O BCash preencheesses requisitos em alguns pontos como: </p>
                <ul>
                    <li>Vários meios de pagamento;</li>
                    <li>Segurança e confiabilidade;</li>
                    <li>Sistema de comissão;</li>
                </ul>
            </div>
            <div class="col-md-7">
                {{ HTML::image('images/hiw_integration.png', '', ['class' => 'img-responsive']) }}
            </div>
        </div>

        <h3>Por que BCash?</h3>
        <p>O ponto principal pela escolha do BCash é que podemos repassar o dinheiro para um conta bcash sua, sem que precisassemos fazer isso manualmente. Dessa forma, você saberá que assim que recebermos o dinheiro, a sua parte também será recebida, vamos cuidar também da parte de cancelamento, estorno e reclamações, tudo para que você não tenha essa dor de cabeça. Obviamente isso tem um custo, que a Battleroad já conta em sua taxa.</p>

        <h3>Mas quanto é essa taxa da Battleroad?</h3>
        <p>A Battleroad cobra 10% sobre as transações, porém chamamos essa taxa de "Taxa Transparente". Por que? Porque essa taxa é transparente tanto para o organizador quanto para o jogador. Funciona assim: <br>
        Vamos supor que para seu campeonato, você deseja receber R$20 de seus jogadores. Na hora de divulgarmos o seu campeonato, vamos mostrar o preço de R$22,22 para o pagamento. Se retirarmos 10% ou R$2,22 de umainscrição, você irá receber exatamente os R$20,00.</p>

        <h3>Mas por que 10%?</h3>
        <p>Além de cobrirmos a taxa do sistema de pagamento, temos os custos do servidor e implementação de novas funcionalidades. Mais pra frente pretendemos diminuir essa taxa e monetizar a Battleroad de alguma forma. Queremos que a comunidade de E-Sports cresça no Brasil, e a única forma de fazermos isso é tornandoacessível a todos, seja desenvolvedor ou organizador.</p>

        <p>Implicitamente nesse preço você terá inúmeras vantagens, como por exemplo: após o primeiro campeonato realizado, você já ganhou um catálogo de clientes, quando você criar um novo campeonato em nossa plataforma, todos os participantes e mais os outros que desejarem receber novidades da Battleroad receberão um e-mail sobre o seu campeonato. A tendência é a comunidade crescer e seu campeonato visível pra muitomais gente!</p>
        <p>Além disso, temos grandes novidades vindo por aí, ainda não está satisfeito? Nos dê sugestão! <a href="
          #">Dá só uma olhada!</a></p>

        <p>Após colocar o e-mail do seu bcash no campo, você irá para a parte de confirmação, veja se está tudo certo e clique em Confirmar. Pronto! Seu campeonato está publicado, divulgue no facebook, twitter e em suas redes sociais do seu novo evento. Agora é só se preocupar com o evento que a Battleroad cuida do resto!</p>
    </div>
@stop