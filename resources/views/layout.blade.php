<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' >
        <title>Trekking</title>
        <style>body {padding-top: 80px;}</style>
        <meta http-equiv="X-FRAME-OPTIONS" content="allow-from https://localhost:8000/">

    </head>
    <body>
        <nav class='navbar navbar-expand-md navbar-dark bg-dark fixed-top'>
            <a class='navbar-brand' href={{route('detail.index')}}>登山ルート.com</a>
        </nav>
        <div class='container'>
        @yield('content')
    </body>
</html>