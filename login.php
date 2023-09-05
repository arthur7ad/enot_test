<?php
$title = "Авторизация";
require_once 'core/initPublic.php';
require_once './head.php';
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'fieldName' => 'Логин',
                'required' => true
            ),
            'password' => array(
                'fieldName' => 'Пароль',
                'required' => true
            )
        ));

        if ($validation->passed()) {
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if ($login) {
                Redirect::to('index.php');
            } else {
                echo "<div class='alert alert-danger'>Ошибка авторизации</div>";
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
        <div class="title">Авторизация</div>
        <input type="text" name="username" id="username" placeholder="Логин*"
               value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"/>
        <input type="password" name="password" id="password" placeholder="Пароль*"/>


        <label for="remember">
            <input type="checkbox" name="remember" id="remember"/> <small>Запомнить меня</small>
        </label>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
        <input type="submit" value="Вход"/>
    </form>

<?php
require_once './foot.php';