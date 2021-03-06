<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">User Management</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Главная</a>
      </li>
      <?  if ($user->hasPermissions('admin')): ?>
        <li class="nav-item">
          <a class="nav-link" href="/users/admin.php">Управление пользователями</a>
        </li>
      <? endif; ?>
    </ul>
    <? if ($user->isLoggedIn()):?>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="profile.php?id=<?=$user->data()->id?>" class="nav-link">Профиль</a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">Выйти</a>
        </li>
      </ul>
    <? else:?>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="login.php" class="nav-link">Войти</a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link">Регистрация</a>
        </li>
      </ul>
    <? endif;?>
  </div>
</nav>
