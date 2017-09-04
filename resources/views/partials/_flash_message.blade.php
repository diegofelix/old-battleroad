@if (Session::has('error'))

    <!-- Error Message -->
    <div class="flash-message alert alert-error">
        @if (Session::get('error') instanceof Illuminate\Support\MessageBag)
            <i class="fa fa-warning"></i>
            <ul>
                @foreach (Session::get('error')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            <p><i class="fa fa-warning"></i> {{ Session::get('error') }}</p>
        @endif
    </div>
    <!-- Error Message -->

@endif

@if (Session::has('message'))

    <!-- Message -->
    <div class="flash-message alert alert-success">
        <p><i class="fa fa-thumbs-up"></i> {{ Session::get('message') }}</p>
    </div>
    <!-- Message -->

@endif

@if (Session::has('status'))

    <!-- Message -->
    <div class="flash-message alert alert-success">
        <p><i class="fa fa-thumbs-up"></i> {{ Session::get('status') }}</p>
    </div>
    <!-- Message -->

@endif