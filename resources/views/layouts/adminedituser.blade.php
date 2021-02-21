<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Редактирование пользователя</title>

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
            Отредактируйте данные
        </div>

        <div >
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">Имя</label>
                        <input type="text" class="form-control" id="username" value="{{ $user->name }}" placeholder="Имя пользователя" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom04">Фамилия</label>
                        <input type="text" class="form-control" id="userlname" value="{{ $user->lastname }}" placeholder="Фамилия пользователя" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">E-mail</label>
                        <input type="email" class="form-control" id="useremail" value="{{ $user->email }}" placeholder="E-mail" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom05">Телефон</label>
                        <input type="text" class="form-control" id="userphone" value="{{ $user->phone }}" placeholder="Телефон" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="usertarif">Тариф</label>
                        <select id="usertarif" class="form-control">
                            @foreach($tarifs as $tarif)
                                @if($tarif['id'] == $user->tarif_id)
                                    <option selected value="{{$tarif['id']}}">{{$tarif['name']}}</option>
                                @else
                                    <option value="{{$tarif['id']}}">{{$tarif['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="usersubscription">Абонемент</label>
                        <select id="usersubscription" class="form-control">
                            @foreach($subscriptions as $subscription)
                                @if($subscription['id'] == $user->subscription_id)
                                    <option selected value="{{$subscription['id']}}">{{$subscription['name']}}</option>
                                @else
                                    <option value="{{$subscription['id']}}">{{$subscription['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" id="userid" value="{{ $user->id }}">
                </div>
                <button style="margin-top: 10px;" class="btn btn-primary btn-submit" type="submit">Обновить</button>
            </form>

            <br>
            <br>
            <br>

            <form action="{{ route('adminuploadfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlFile1">Загрузить файл</label>
                    <input type="file" name="image" accept="image/*,image/jpeg">
                </div>
                <input type="hidden" id="userid" name="userid" value="{{ $user->id }}">
                <button class="btn btn-default" type="submit">Загрузить фото</button>
            </form>

            <br>
            <div  id="contentdataapi">

            </div>
            <br><br><br>
            <div class="links">
                <a href="{{ url('/admin/show') }}">Вернуться в Админ панель</a>
            </div>
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
    function setResult()
    {
        $.ajax({
            type: "POST",
            url: '{{route("useradminupdate")}}',
            cache: false,
            data: "username="+$("#username").val()+"&userlname="+$("#userlname").val()+"&useremail="+$("#useremail").val()+"&userphone="+$("#userphone").val()+"&usertarif="+$("#usertarif").val()+"&usersubscription="+$("#usersubscription").val()+"&userid="+$("#userid").val(),
            success: function(html){
                $("#contentdataapi").html(html);
            }
        });
    }

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e){
            e.preventDefault();
            setResult();
        });
    });
</script>

</body>
</html>
