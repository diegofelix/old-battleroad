@extends ('layouts.default')
@section ('content')

    @include ('partials._featured_title', ['title' => $championship->name])

    <div id="champ-manage">
        <div class="container">
            <div class="row">
                <div id="description" class="col-md-8 show-hide">
                    <div class="description-label"><h3>Informações</h3></div>
                    <figure class="image info">
                        <header>
                            <h3>Imagem</h3>
                        </header>
                        <section>
                            {{ HTML::image($championship->image, $championship->name, ['class' => 'img-responsive']) }}
                        </section>
                    </figure>
                    <div class="description info">
                        <header>
                            <h3>Descrição</h3>
                        </header>
                        <section>
                            {{ $championship->description }}
                        </section>
                    </div>
                    <div class="location info">
                        <header>
                            <h3>Local</h3>
                        </header>
                        <section>
                            {{ $championship->location }}
                        </section>
                    </div>
                    <div class="price info">
                        <header>
                            <h3>Taxa Entrada</h3>
                        </header>
                        <section>
                            {{ $championship->price }}
                        </section>
                    </div>
                    <div class="price info">
                        <header>
                            <h3>Início do Evento</h3>
                        </header>
                        <section>
                            {{ $championship->event_start }}
                        </section>
                    </div>
                    <div class="price info">
                        <header>
                            <h3>Encerramento das Inscrições</h3>
                        </header>
                        <section>
                            {{ $championship->event_end }}
                        </section>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div id="payments" class="col-md-11 col-md-offset-1 show-hide">
                            <div class="price info">
                                <header>
                                    <h3>Últimos pagamentos</h3>
                                </header>
                                <section>
                                    {{ $championship->event_start }}
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="publish" class="col-md-11 col-md-offset-1">
                            @if ($championship->published)
                                <a href="#" class="btn btn-default btn-block champ-button disabled">Publicado</a>
                            @else
                                <a href="#" class="btn btn-default btn-block champ-button">Publicar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- champ-manage -->
@stop