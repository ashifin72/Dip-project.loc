<?php
include_once 'init.php';

if (Input::exiist()) { // если поля заполненны
  if (Token::check(Input::get('token'))) { // токен верен
    $validate = new Validate();
    $validate->check($_POST, [
        'email' => [
            'required' => true,
            'email' => true,

        ],
        'password' => [
            'required' => true,
        ],
    ]);

    if ($validate->passed()) {// если валидация пошла
      $user = new User();// создаем user  и проеряем на соответвие почты и пароля
      // загоняем в переменную значение отмечен true  или нет false remember
      $remember = (Input::get('remember')) === 'on' ? true : false;
      $login = $user->login(Input::get('email'), Input::get('password'), $remember);
      if ($login) {
        Redirect::to('index.php');
      } else {
        $alert = 1;

//        $validate->addError('Ошибка авторизации!');
      }
    } else {
      $alert = 2;
    }
  }
}


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" method="post">
  <img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>

  <? if ($alert == 2) : ?>
    <div class="alert alert-danger">
      <ul>
        <? foreach ($validate->errors() as $error) { ?>

          <li> <?= $error; ?></li>
        <? } ?>
      </ul>
    </div>
  <? elseif ($alert == 1): ?>

    <div class="alert alert-info">
      Логин или пароль неверны
    </div>
  <? endif; ?>
  <div class="form-group">
    <input type="email" class="form-control" name="email" value="<?= Input::get('email'); ?>" placeholder="Email">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" placeholder="Пароль">

  </div>
  <input type="hidden" name="token" value="<?= Token::generate(); ?>">

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" name="remember"> Запомнить меня
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
</body>
</html>
