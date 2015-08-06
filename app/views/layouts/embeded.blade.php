<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="@yield('meta_description', 'O primeiro site de campeonatos do brasil!')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('meta')

    <meta name="google-site-verification" content="QlRQqaIL0xz5aGS-ZENdKQKdTNaUQfiphyBgVJV_-u4" />

        <title>Battleroad - @yield('title', 'De olho nos campeões')</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" >

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,900' rel='stylesheet' type='text/css'>

        {{ HTML::style('css/main.css') }}

    </head>

    <body>

        <div id="wrapper">

            @include ('partials._flash_message')

            <div id="content">
                @yield('content')
            </div>
        </div><!-- wrapper -->
    @yield('scripts')
    </body>
</html>
