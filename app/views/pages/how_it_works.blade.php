@extends ('layouts.default')

@section ('content')

    <div class="featured-title">
        <div class="container">
            <h2 class="wow fadeInLeft">Como funciona?</h2>
        </div>
    </div>

    <div class="piece">
        <div class="container">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#organizer" data-toggle="tab">Para o organizador</a></li>
                <li><a href="#player" data-toggle="tab">Para o jogador</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="organizer">
                    <p>Através de nossa ferramenta é possível criar um campeonato, adicionar os jogos que estarão no campeonato, definir o preço de entrada para o campeonato, preço de participação de um jogo. Dessa forma, você se preocupa com o evento, e deixa que nós cuidamos do pagamento.</p>

                    <p>Assim que um jogador desejar se inscrever no seu campeonato, iremos manda-lo para a nossa página de pagamento. Assim que o pagamento for efetuado iremos avisa-lo sobre o pagamento e qualquer mudança no status do pagamento.</p>

                    <h3>Quanto custa?</h3>

                    <p>Para se criar um campeonato não custa nada, porém se você pretende cobrar dos jogadores para participarem, nós cobraremos uma taxa fixa de 10% sobre o valor total arrecadado do campeonato. Esse valor serve para cobrir nossos custos da plataforma e para podermos disponibilizar todas as formas de pagamento, como boleto, débito em conta, cartão de crédito e etc.</p>

                    <p>O valor será repassado na inscrição do campeonato, a Champaholic calcula automaticamente pra você na hora de criar o valor da inscrição, por exemplo: Vamos Supor que você queira receber 50 reais por participante, automaticamente o valor de inscrição para o participante será R$55 reais. Ou seja, esse valor é transparente para o jogador.</p>

                    <h3>Como receberei o dinheiro?</h3>

                    <p>No momento em que você criou um campeonato e decidiu que cobrará para os participantes. Nós te guiaremos para a criação de uma conta MOIP ( Sistema de pagamentos ), que é por onde te enviaremos o dinheiro. Você precisará nos enviar alguns dados para confirmar que você é realmente quem diz ser. Dessa forma podemos te enviar o dinheiro com maior segurança.</p>

                    <p>Assim que você fechar as inscrições para o campeonato, temos um prazo de 3 a 4 dias para confirmação dos pagamentos pendentes. Passado esses 3 dias ( ou até que todos os pagamentos se confirmem) enviamos o dinheiro diretamente na sua conta MOIP.</p>

                    <h3>Como vou sacar o dinheiro?</h3>

                    <p>Assim que o dinheiro cair na sua conta MOIP você poderá sacar o dinheiro, o prazo para cair na conta do seu banco não deve passar de 3 dias úteis ( Dependendo do banco ).</p>

                    <h3>Quais as vantagens de usar a champaholic?</h3>

                    <p>Primeiramente, chega de depósitos de centavos na sua conta. Todo o sistema de pagamento será cuidado por nós. Além disso o usuário cadastrado receberá um e-mail sempre que você criar um novo campeonato. dessa forma o seu campeonato atingirá muito mais pessoas. Seu campeonato será divulgado em nossa página e quanto mais próximo estiver da data do evento, mais destaque ele ganhará na página inicial. Teremos muitas novidades conforme a plataforma for crescendo, dá uma olhada no que está por vir!</p>

                    <h3>Posso cancelar o campeonato após ele ser criado?</h3>

                    <p>Sim, você pode cancelar o campeonato caso ele não atinja o número mínimo de participantes.</p>

                    <h3>Posso editar o campeonato após publicado?</h3>

                    <p>Sim. Algumas informações você poderá alterar a qualquer momento. Algumas informações mais sensíveis só poderão ser alteradas se nenhum participante se inscreveu no campeonato, como por exemplo: preço, jogo, plataforma do jogo.</p>
                </div>
                <div class="tab-pane" id="player">
                    <h3>Quanto custa pra participar dos campeonatos?</h3>

                    <p>Depende do campeonato. Poderá ter campeonatos gratuitos e pagos, quem define é o organizador do campeonato.</p>

                    <h3>Quais as vantagens de participar de um campeonato por aqui?</h3>

                    <p>Você fará parte da maior rede de campeonatos do Brasil, sempre que surgir um campeonato de seu interesse, você receberá um e-mail avisando o dia e hora do evento. Você poderá escolher a forma de pagamento e até parcelar a sua entrada, temos boleto, cartão de crédito, débito e muito mais. Além disso, estamos preparando muita novidade, dá só uma olhada.</p>

                    <h3>Quais jogos estão disponíveis?</h3>

                    <p>Antes de inserirmos um jogo, precisamos saber como é o modelo no qual esse jogo se encaixa. Cada jogo tem um padrão e pra isso, precisamos analisar todas as vertentes antes de adicionar um jogo à plataforma, Por exemplo: Street Fighter é 1x1, já league of legends é 4x4. Estamos trabalhando duro para atender ao máximo de jogos possíveis.</p>

                    <h3>Posso cancelar minha inscrição no campeonato?</h3>

                    <p>Sim. Seu dinheiro ficará como crédito em nosso sistema, assim, quando você quiser participar de outro campeonato, poderá usar esses créditos para entrar no campeonato. Caso você queira receber o dinheiro, basta solicitar através do seu perfil.</p>

                    <p>Ainda tem dúvidas? <a href="#">Entre no nosso canal de suporte.</a></p>
                </div>
            </div>

        </div>
    </div>

@stop