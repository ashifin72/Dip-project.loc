<?
include_once '../init.php';
$user= new User();
if (!$user->hasPermissions('admin')){
  Redirect::to('/index.php');
}



$validate = new Validate();
$alert = '';
if (!$_GET['id']) {
  Redirect::to('index.php');
}
 $validate->check($_GET, [
    'id' => [
        'required' => true,
        'min' => 1,
        'int' => true,
        'have' => 'users'
    ],
]);
if ($validate->passed()) {
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

      Redirect::to('edit.php?id=' . $id);
      exit();
      $alert = 1;
    } else {
      $alert = 2;
    }
  }
}
?>
<? include_once '../views/header.php' ?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <? if ($validate->errors()) : ?>
        <div class="alert alert-danger">
          <ul>
            <? foreach ($validate->errors() as $error) { ?>
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
      <? if ($user->data()->id == $id || $user->hasPermissions('admin')): ?>

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