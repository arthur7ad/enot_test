<?php
$title = "Регистрация";
require_once 'core/initPublic.php';
require_once './head.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'fieldName' => 'Логин',
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'fieldName' => 'Пароль',
                'required' => true,
                'min' => 6
            ),
            'passwordAgain' => array(
                'fieldName' => 'Пароль повторно',
                'required' => true,
                'min' => 6,
                'matches' => 'password'
            ),
            'name' => array(
                'fieldName' => 'Имя',
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if ($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);
            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'userGroup' => 1
                ));
                Session::flash('home', 'Вы зарегистрировались и теперь можете войти в систему');
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
        <div class="title">Регистрация</div>
            <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" placeholder="Логин*" autocomplete="off"/>
            <input type="password" name="password" id="password"  placeholder="Пароль*"/>
            <input type="password" name="passwordAgain" id="passwordAgain"  placeholder="Пароль повторно*"/>
            <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>"  placeholder="Имя*"/>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
        <input type="submit" value="Регистрация"/>
    </form>
<?php
require_once './foot.php';