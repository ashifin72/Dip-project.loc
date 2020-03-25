<?
include_once 'init.php';
if (Input::exiist())
  if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'username' => [
            'required' => true,
            'min' => 2,
            'max' => 15,

        ],
        'email' => [
            'required' => true,
            'email' => true,
            'unique' => 'users'
        ],
        'password' => [
            'required' => true,
            'min' => 2,

        ],
        'password_again' => [
            'required' => true,
            'matches' => 'password'
        ]

    ]);
    // в данном случае я решил что выводить сообщения через перебор $alert  удобнее
    $alert = '';
    $consent = (Input::get('consent')) === 'on' ? true : false;
    if ($consent){
      if ($validation->passed()) {

        $user = new User();
        $user->create([
            'email' => Input::get('email'),
            'username' => Input::get('username'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
        ]);
        $alert = 1;
        Session::flash('success', 'Регистрация удачная');
      } else {
        $alert = 2;
        $validation->errors();
      }
    }else{
      $alert = 2;
      $validate->addError('Вы не согласились с правилами!');
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
    	  <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>

      <? if ($alert == 2) :?>
      <div class="alert alert-danger">
        <ul>
      <? foreach ($validation->errors() as $error) { ?>

            <li> <?= $error; ?></li>
          <?}?>
          </ul>
        </div>
      <? elseif ($alert == 1):?>

        <div class="alert alert-success">
          Вы зарегистрированы в системе! <br>
          <a href="index.php">перейти на главную</a>
        </div>
      <? else:?>

        <div class="alert alert-info">
           Заполните все поля!
        </div>
      <? endif;?>

    	  <div class="form-group">
          <input type="email" class="form-control" name="email"
                 value="<? if ($alert !== 1): echo Input::get('email'); endif; ?>" placeholder="Email"'>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Ваше имя" value="<? if ($alert !== 1): echo Input::get('username'); endif; ?>">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Пароль">
        </div>
        
        <div class="form-group">
          <input type="password" class="form-control" name="password_again" placeholder="Повторите пароль">
        </div>
      <input type="hidden" name="token" value="<?= Token::generate(); ?>">

    	  <div class="checkbox mb-3">
    	    <label>
    	      <input type="checkbox" name="consent"> Согласен со всеми правилами
    	    </label>
    	  </div>
    	  <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
    	  <p class="mt-5 mb-3 text-muted">&copy; 2017-<?= date('Y')?></p>
    </form>
</body>
</html>
