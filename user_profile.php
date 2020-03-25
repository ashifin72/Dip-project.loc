<?php
include_once 'init.php';

////ash_debug($users);
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
  Redirect::to('index.php');
}

?>
<? include_once 'views/header.php' ?>
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h1>Данные пользователя <?= $user_profil->data()->username?></h1>
         <table class="table">
           <thead>
             <th>ID</th>
             <th>Имя</th>
             <th>Дата регистрации</th>
             <th>Статус</th>
           </thead>

           <tbody>
             <tr>
               <td><?= $user_profil->data()->id?></td>
               <td><?= $user_profil->data()->username?></td>
               <td><?= $user_profil->data()->date_registr?></td>
               <td><?= $user_profil->data()->status?></td>
             </tr>
           </tbody>
         </table>


       </div>
     </div>
   </div>
</body>
</html>