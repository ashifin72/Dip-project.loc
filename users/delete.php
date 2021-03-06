<?php
include_once '../init.php';
$user = new User();
if (!$user->hasPermissions('admin')){
  Redirect::to('/index.php');
}


//ash_debug($users);
//$user = new User();

$validate_id = new Validate();
$alert = '';
if (!$_GET['id']) {
  Redirect::to('/index.php');
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
  Database::getInstance()->delete('users', ['id', '=', $id]);

  Session::flash('success', 'Пользователь удален!');

  Redirect::to('/users/admin.php');


} else {
  $alert = 2;
}

