<div class="row">
    @foreach ($championship->competitions as $competition)
        <div class="modal fade" id="modal-{{$competition->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ $competition->game->name }}</h4>
                    </div>
                    <div class="modal-body">
                        @include('join/partials/competition_players')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Salvar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach
</div>