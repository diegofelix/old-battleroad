@extends ('layouts.default')

@section ('content')

    <div class="featured-title">
        <div class="container" id="how_it_works">
            <h2 class="wow fadeInLeft">Como funciona?</h2>
            <p>Antes de respondermos essa pergunta, precisamos saber...</p>
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-block btn-success btn-xlg" href="{{ route('how_player') }}">
                        <span class="fa fa-gamepad fa-lg"></span> Sou um Jogador
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="pull-right btn btn-block btn-info btn-xlg" href="{{ route('how_organizer') }}">
                        <span class="fa fa-gamepad fa-lg"></span> Sou um organizador
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop