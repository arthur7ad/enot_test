<?php
$title = "Сменить пароль";
require_once 'core/initPublic.php';
require_once './head.php';
	$user = new User();

	if (!$user->isLoggedIn()) {
		Redirect::to('index.php');
	}

	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'currentPassword' => array(
					'fieldName'	=> 'Действующий пароль',
					'required' 	=> true,
					'min'		=> 6,
					'max'		=> 50
				),
				'newPassword' => array(
					'fieldName'	=> 'Новый пароль',
					'required' 	=> true,
					'min'		=> 6,
					'max'		=> 50
				),
				'newPasswordAgain' => array(
					'fieldName'	=> 'Новый пароль повторно',
					'required' 	=> true,
					'min'		=> 6,
					'max'		=> 50,
					'matches'	=> 'newPassword'
				)
			));

			if ($validation->passed()) {
				$user = new User();
				if (Hash::make(Input::get('currentPassword'), $user->data()->salt) !== $user->data()->password) {
					echo 'Действующий пароль не правильный';
				} else {
					$salt = Hash::salt(32);
					$user->update(array(
						'password' 	=> Hash::make(Input::get('newPassword'), $salt),
						'salt' 		=> $salt
					));
					Session::flash('home','Ваш пароль был обновлен');
					Redirect::to('index.php');
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error;
				}
			}
		}
	}
?>

<form action="" method="post" class="form">
		<input type="password" name="currentPassword" id="currentPassword" placeholder="Действующий пароль*"/>
		<input type="password" name="newPassword" id="newPassword" placeholder="Новый пароль*"/>
		<input type="password" name="newPasswordAgain" id="newPasswordAgain" placeholder="Новый пароль повторно*"/>

	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
	<input type="submit" value="Обновить"/>
</form>

<?php
require_once './foot.php';