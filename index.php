<?php
require_once 'core/initPublic.php';
require_once './head.php';

if (Session::exists('home')) {
    echo Session::flash('home');
}


?>

<?php
$user = new User();
if ($user->isLoggedIn()) {
    ?>
    <p>Привет,
        <a href="/profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!
    </p>

    <div class="title">Конвертер валют</div>
    <div class="converter">

        <?


        $currency = Database::getInstance()->selectAll('currency');
        $results = $currency->results();

        if ($currency->count()) {

        ?>
        <form action="" method="post" id="ajax_form">


            <input type="number" name="amount1" id="amount1"
                   value="1" min="1" placeholder="Количество" autocomplete="off"/>


            <select name="currency1" id="select1">
                <?
                echo "<option value = 'RUB'>Российский рубль</option>";
                foreach ($results as $currency1) {

                    echo "<option value = '$currency1->code'> $currency1->name_ru </option>";

                }

                ?>
            </select>
            <div class="arrow"><img src="/style/img/ar.png" alt="↑↓"></div>

            <input type="number" name="amount2" id="amount2"
                   value="1" min="1" placeholder="Количество" autocomplete="off"/>
            <select name="currency2" id="select2">
                <?
                echo "<option value = 'RUB'>Российский рубль</option>";
                foreach ($results as $currency2) {

                    echo "<option value = '$currency2->code'> $currency2->name_ru </option>";

                }

                ?>
            </select>

            <div id="results"></div>

            <?php

            }


            ?>

    </div>
    <ul>
        <li><a href="update.php">Обновить профиль</a></li>
        <li><a href="changepassword.php">Сменить пароль</a></li>
        <li><a href="logout.php">Выйти</a></li>
    </ul>
    <?php
} else {
    ?>
    <p>Привет, гость!
    </p>
    Для доступа к конвертеру, надо <a href='login.php'>авторизироваться</a> или <a href='register.php'>зарегистрироваться</a>

    <div class="accountant"><img src="/style/img/grif.gif"></div>
    <?php
}
?>

<?php
require_once './foot.php';
?>