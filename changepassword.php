<?php
include_once 'init.php';
$user = new User();
$validate_id = new Validate();
$alert = '';
if (!$_GET['id']) {
//  Redirect::to('index.php');
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
  echo 'не верное значение';
  exit();
}
if ($user_profil->data()->id !== $id || $user_profil->hasPermissions('admin')){

//  Redirect::to('index.php');
//  exit();
}

$validate = new Validate();
if (Input::exiist()) {
  if (Token::check(Input::get('token'))) {
    $validate->check($_POST, [
        'current_password' => ['required' => true, 'min' => 4],
        'new_password' => ['required' => true, 'min' => 4],
        'new_password_again' => ['required' => true, 'min' => 4, 'matches' => 'new_password'],
    ]);
    $alert = '';
    if ($validate->passed()) {
      if (password_verify(Input::get('current_password'), $user_profil->data()->password)) {
        Database::getInstance()->update('users', $id, ['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);

        Session::flash('success', 'Ваш пароль изменен!');
        Redirect::to('changepassword.php?id=' . $id);
        exit();
      } else {
        $alert = 2;
        $validate->addError('Старый пароль не верен!');
      }

    } else {
      $alert = 2;
    }
  }
}

include_once 'views/header.php';
?>

   <div class="container">
     <div class="row">
       <div class="col-md-8">
         <h1>Изменить пароль <?=$user_profil->data()->username?></h1>
         <? if (Session::exists('success')): ?>
           <div class="alert alert-success">
             <? echo Session::flash('success', 'Ваш пароль изменен!');?>
           </div>
         <? endif; ?>

         <? if ($alert == 2) : ?>
           <div class="alert alert-danger">
             <ul>
               <? foreach ($validate->errors() as $error) { ?>
                 <li> <?= $error; ?></li>
               <? }
               die(); ?>
             </ul>
           </div>
         <? endif; ?>
         <ul>
           <li><a href="profile.php?id=<?=$id?>">Изменить профиль</a></li>
         </ul>
         <form action="" class="form" method="post">
           <div class="form-group">
             <label for="password">Текущий пароль</label>
             <input type="password" id="current_password" name="current_password" class="form-control">
           </div>
           <div class="form-group">
             <label for="current_password">Новый пароль</label>
             <input type="password" id="new_password" name="new_password" class="form-control">
           </div>
           <div class="form-group">
             <label for="current_password">Повторите новый пароль</label>
             <input type="password" id="new_password_again" name="new_password_again" class="form-control">
           </div>
           <input type="hidden" name="token" value="<?= Token::generate(); ?>">

           <div class="form-group">
             <button class="btn btn-warning">Изменить</button>
           </div>
         </form>


       </div>
     </div>
   </div>
</body>
</html>