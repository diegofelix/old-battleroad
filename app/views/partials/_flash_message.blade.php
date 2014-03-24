@if (Session::has('error'))

    <!-- Error Message -->
    <div class="flash-message alert alert-error">
        <p><i class="icon icon-warning"></i> {{ Session::get('error') }}</p>
    </div>
    <!-- Error Message -->

@endif

@if (Session::has('message'))

    <!-- Message -->
    <div class="flash-message alert alert-success">
        <p><i class="icon icon-thumbs-up"></i> {{ Session::get('message') }}</p>
    </div>
    <!-- Message -->

@endif