@extends ('layouts.default')
@section ('content')

    @include('partials._admin_sidebar')

                <div class="col-md-9 champ-description">
                    @yield('champ-content')
                </div><!-- champ-description -->

    {{-- I need to improve this code, but, for now, dont drop the close divs below --}}
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- champ-manage -->
@stop

@section('scripts')
    {{ HTML::script('js/bootstrap-datepicker.js') }}
@stop