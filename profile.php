<?php
require_once 'core/initPublic.php';
require_once './head.php';
if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User($username);
    if (!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
    }
    ?>
    <h3><?php echo escape($data->username); ?></h3>
    <p>Имя: <?php echo escape($data->name); ?></p>
    <p>Дата регистрации: <?php echo escape($data->joined); ?></p>
    < <a href="/">На главную</a>
    <?php
}

require_once './foot.php';
?>