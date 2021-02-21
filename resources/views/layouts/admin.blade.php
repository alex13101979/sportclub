<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Админ панель</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Админ панель
        </div>
        <div id="usershow">
        </div>
        <br><br><br>
        <div class="links">
            <a href="{{ url('/') }}">Вернуться на главную страницу</a>
        </div>
    </div>
</div>

<!-- Подключаем jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Подключаем плагин Popper (необходим для работы компонента Dropdown и др.) -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- Подключаем Bootstrap JS -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script>
    function showUser()
    {
        $.ajax({
            url: '{{route("admingetusers")}}', // загружает вот это страницу каждую минуту
            cache: false,
            success: function(html){
                $("#usershow").html(html);
            }
        });
    }

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Обновляем динамически кол-во суперагентов и полисов
        showUser();
        setInterval('showUser()',10000);
    });
</script>

</body>
</html>
