<!DOCTYPE html>
<html>
<head>
    <title>Данные для входа</title>
    <meta name="description" content="
    Данные для входа ДонНУ">
</head>

<body>
<h3>Здравствуйте</h3>
<br/>
Ваша почта была подтверждена - {{$user['email']}}. Теперь вы имеете доступ к системе Кафедры Компьютерных технологий ДонНУ г. Винница. Вы можете изменить их на сайте.
<br/>
<b>Данные для входа:</b>
<br/>
Логин: {{$user['username']}}
<br/>
Почта: {{$user['email']}}
<br/>
Пароль: {{$user['email']}}
<br/>
<a href="{{url('http://sciencerating/public/'.App\Http\Middleware\LocaleMiddleware::getLocale())}}">Сайт Научного рейтинга кафедры КТ</a>
@if($user['type'] == \App\User::PROFESSOR)
    <br/>
    <a href="{{url('http://systemforuniver/web')}}">Сайт системы удалённых работ</a>
@endif
<br/>
При подтверждении регистрации вы соглашаетесь с "Условиями использования".
Если вы получили письмо по ошибке, то проигнорируйте письмо.
</body>

</html>