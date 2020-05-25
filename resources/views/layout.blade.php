<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet">
    <script src="/js/app.js" defer></script>
    @yield("customStyles")
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .content-wrapper{
            min-height: calc(100vh - 192px);
        }
    </style>
</head>
<body class="bg-gray-800">

<div id="app">
    <navbar-component :user='@json(Auth::user())'></navbar-component>
    <div class="content-wrapper">
        @yield("content")
    </div>
    <footer-component></footer-component>
</div>

<script>
    feather.replace()
</script>
</body>
</html>
