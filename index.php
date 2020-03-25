<?php
include_once 'init.php';

//ash_debug($users);
$user = new User();
?>
<? include_once 'views/header.php'?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">

        <h1 class="display-4">Привет, мир!</h1>
        <p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
        <hr class="my-4">
        <p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>
        <a class="btn btn-primary btn-lg" href="register.php" role="button">Зарегистрироваться</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">

      <h1>Пользователи</h1>
      <table class="table">
        <thead>
        <tr>
          <th>ID</th>
          <th>Имя</th>
          <th>Email</th>
          <th>Дата</th>
        </tr>
        </thead>

        <tbody>
        <? $users = Database::getInstance()->all('users');
        if ($users->count()): ?>
          <? foreach ($users->results() as $user) {
            ?>
            <tr>
              <td><?= $user->id ?></td>
              <td><a href="user_profile.php?id=<?= $user->id ?>"><?= $user->username ?></a></td>
              <td><?= $user->email ?></td>
              <td><?= $user->date_registr ?></td>
            </tr>
            <?
          }
        else: ?>
          <h2> Пока ни одного пользователя не зарегистрированно</h2>
        <? endif; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>