<html>
    <head>
        <!-- <title>Tittle Halaman</title> -->
        <title>@yield('title')</title>
    </head>
    <body>
        <h1>Ini adalah header</h1>
        <hr/>
        @include('template.nav')
        <br/>
        <!-- <p>Ini adalah content</p> -->
        @yield('content')
        <hr/>
        <footer>Ini adalah footer</footer>
    </body>
</html>