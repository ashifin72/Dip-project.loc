<?php
include_once 'init.php';

//ash_debug($users);
$user = new User();

$validate_id = new Validate();
$alert = '';
if (!$_GET['id']) {
  Redirect::to('index.php');
}
$valid_id = $validate_id->check($_GET, [
    'id' => [
        'required' => true,
        'min' => 1,
        'int' => true,
        'have' => 'users'
    ],
]);
if ($valid_id->passed()) {
  $id = $_GET['id'];
  $user_profil = new User($id);

} else {
  $alert = 2;
}

$validate = new Validate();
if (Input::exiist()) {
  if (Token::check(Input::get('token'))) {
    $validate->check($_POST, [
        'username' => [
            'required' => true,
            'min' => 3,
            'max' => 15,
        ],
        'status' => [
            'required' => true,
            'min' => 5,
            'max' => 250,
        ]
    ]);
    $alert = '';
    if ($validate->passed()) {
      Database::getInstance()->update('users', $id, [
          'username' => Input::get('username'),
          'status' => Input::get('status')
      ]);
      Session::flash('success', 'Данные изменены!');

      Redirect::to('profile.php?id=' . $id);
      $alert = 1;
    } else {
      $alert = 2;
    }
  }
}


?>
<? include_once 'views/header.php' ?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <? if ($alert == 2) : ?>
        <div class="alert alert-danger">
          <ul>
            <? foreach ($valid_id->errors() as $error) { ?>
              <li> <?= $error; ?></li>
            <? }
            die(); ?>
          </ul>
        </div>
      <? endif; ?>
      <? if (Session::exists('success')): ?>
        <div class="alert alert-success">
          <? echo Session::flash('success', 'Данные изменены!');?>
        </div>
      <? endif; ?>

      <h1>Профиль пользователя - <?= $user_profil->data()->username ?> </h1>
      <? if ($user_profil->data()->id == $id || $user->hasPermissions('admin')): ?>
        <ul>
          <li><a href="changepassword.php?id=<?= $id ?>">Изменить пароль</a></li>
        </ul>
        <form action="" class="form" method="post">
          <div class="form-group">
            <label for="username">Имя</label>
            <input type="text" name="username" class="form-control" value="<?= $user_profil->data()->username ?>">
          </div>
          <div class="form-group">
            <label for="status">Статус</label>
            <input type="text" name="status" class="form-control" value="<?= $user_profil->data()->status ?>">
          </div>
          <input type="hidden" name="token" value="<?= Token::generate(); ?>">
          <div class="form-group">
            <button type="submit" class="btn btn-warning">Обновить</button>
          </div>
        </form>
      <? else: ?>
        Просто данные профили
      <? endif; ?>


    </div>
  </div>
</div>
</body>
</html>