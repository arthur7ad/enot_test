<?php
$title = "Обновить профиль";
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
				'name'	=> array(
					'fieldName'	=> 'Имя',
					'required' 	=> true,
					'min'		=> 2,
					'max'		=> 50
				)
			));

			if ($validation->passed()) {
				$user = new User();
				try {
					$user->update(array(
						'name' => Input::get('name')
					));
					Session::flash('home','Профиль был обновлён!');
					Redirect::to('index.php');
				} catch (Exception $e) {
					die($e->getMessage());
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
    Имя:
	<input type="text" name="name" id="name" value="<?php echo escape($user->data()->name); ?>" placeholder="Имя*" autocomplete="off"/>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
	<input type="submit" value="Обновить"/>
</form>
    < <a href="/">На главную</a>
<?php
require_once './foot.php';