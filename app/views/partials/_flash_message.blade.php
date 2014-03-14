@if (Session::has('error'))

    <!-- Error Message -->
    <div class="flash-message alert alert-error">
        {{ Session::get('error') }}
    </div>
    <!-- Error Message -->

@endif

@if (Session::has('message'))

    <!-- Message -->
    <div class="flash-message alert alert-success">
        {{ Session::get('message') }}
    </div>
    <!-- Message -->

@endif