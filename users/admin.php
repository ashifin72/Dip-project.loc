<?php
include_once '../init.php';
$user = new User();
if (!$user->hasPermissions('admin')){
  Redirect::to('/index.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">User Management</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/index.php">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Управление пользователями</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <li class="nav-item">
              <a href="/profile.php" class="nav-link">Профиль</a>
            </li>
            <a href="/logout.php" class="nav-link">Выйти</a>
          </li>
        </ul>
      </div>
  </nav>

    <div class="container">
      <div class="col-md-12">
        <? if (Session::exists('success')): ?>
          <div class="alert alert-success">
            <? echo Session::flash('success', 'Данные изменены!');?>
          </div>
        <? endif; ?>
        <h1>Пользователи</h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Действия</th>
            </tr>
          </thead>

          <tbody>
          <? $users = Database::getInstance()->all('users');
          if ($users->count()): ?>
          <? foreach ($users->results() as $user) {
          ?>
            <tr>

              <td><?= $user->id ?></td>
              <td><?= $user->username ?></td>
              <td><?= $user->email ?></td>
              <td>
                <? if ($user->group_id == 1):?>
              	<a href="status.php?id=<?= $user->id ?>" class="btn btn-success">Назначить администратором</a>
              <? else:?>
                <a href="status.php?id=<?= $user->id ?>" class="btn btn-danger">Разжаловать</a>
              <? endif;?>
                <a href="/user_profile.php?id=<?= $user->id ?>" class="btn btn-info">Посмотреть</a>
                <a href="edit.php?id=<?= $user->id ?>" class="btn btn-warning">Редактировать</a>
                <a href="delete.php?id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
              </td>

            </tr>
            <? } else: ?>
            <h2> Пока ни одного пользователя не зарегистрированно</h2>
            <? endif; ?>

          </tbody>
        </table>
      </div>
    </div>  
  </body>
</html>
