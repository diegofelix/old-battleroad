@extends ('layouts.admin_championship')
@section ('champ-content')
    <h3>
        <i class="fa fa-envelope"></i> Correio <small>Mande recado para os seus inscritos.</small>
    </h3>

    <hr>

    <p><a href="{{ route('admin.championships.mail.compose', $championship->id) }}" class="btn btn-success">Escrever</a></p>

    <div class="panel panel-default">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>E-mails anteriores</th>
                    {{-- <th>Ações</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($championship->campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->subject }}</td>
                        {{-- <td>
                            <a
                                href="{{ route('admin.championships.mail.summary', [$championship->id, $campaign->id]) }}"
                                class="btn btn-xs btn-info"
                            >
                                <i class="fa fa-eye"></i>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer"><p class="help-block">Funcionalidade em desenvolvimento, em breve mais ferramentas para seus e-mails.</p></div>
    </div>
@stop
@section('scripts')
    {!! HTML::script('js/register.js') !!}
@stop