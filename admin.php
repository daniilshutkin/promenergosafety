<?php
$errors = [];
if (isset($_POST['btn-in'])) {
    $user = 0;
    $login = trim($_POST["login"]);
    $loginLen = mb_strlen($login);
    $pass = trim($_POST["pass"]);
    $passLen = mb_strlen($pass);

    $r_host = "localhost";
    $r_user = "root";
    $r_password = "";
    $r_database = "register";
    $check = new mysqli($r_host, $r_user, $r_password, $r_database);
    
    if ($passLen == 0 || $loginLen == 0) {
        $errors[] = 'Заполните все поля';

    }elseif (preg_match("/[А-Яа-я!@#$%^&*(:)№;?~`<>'{}()|\/<>]/", $login)) {
        $errors[] = 'Поле логина должно содержать только латинские буквы и числа';

    }elseif ($loginLen > 20) {
        $errors[] = 'Логин не должен быть длиннее 20 символов';

    }elseif ($loginLen < 10) {
        $errors[] = 'Логин не должен быть меньше 10 символов';

    }elseif (preg_match("/[А-Яа-я!@#$%^&*(:)№;?~`<>'{}()|\/<>]/", $pass)) {
        $errors[] = 'Поле пароля должно содержать только латинские буквы и числа';

    }elseif ($passLen > 20) {
        $errors[] = 'Пароль не должен быть длиннее 20 символов';
        
    }elseif ($passLen < 10) {
        $errors[] = 'Пароль не должен быть меньше 10 символов';

    }
    
    if(empty($errors)){
      $result = mysqli_query($check, "SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
    // var_dump($result);
      $user = $result->fetch_assoc();
      if ($user == 0) {
            $errors[] = 'Такого пользователя не существует';
        }
    }

    if(empty($errors)){
        setcookie('user',$user['name'],time() + 3600, "/");
        header("Location: index.php"); 
    }

}
?>

<DOCTUPE HTML!>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Промэнергобезопасность</title>
        <link rel="stylesheet" href="css/Design.css">
    </head>
    <body>
        <h1><img src="css/peb.png" width="177" height="123" align="middle">Промэнергобезопасность</h1>
        <ul>
            <li><a href="index.php">База данных</a></li>
            <li><a href="admin.php">Администратор</a></li>
            <li><a href="back.php">Обратная связь</a></li>
        </ul>
    </body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Промэнергобезопасность</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="admin">

    <?php
    if (!isset($_COOKIE['user'])) $_COOKIE['user'] = '';
    if ($_COOKIE ['user'] == 'nenuzhno'):
    ?>
    <h3>Форма регистрации</h3>
    <form action="vendor/check.php" method="post">
        <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя"><br>
        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
        <input type="text" class="form-control" name="pass" id="pass" placeholder="Введите пароль"><br>
        <button class="btn btn-success" type="submit">Зарегистрировать</button>
    </form>
    <?php endif; ?>

    <?php
    if (!empty($_COOKIE ['user'] == 'adminpanel')):
    ?>
    <p align="center">
        Чтобы выйти из режима администратора нажмите <a href="vendor/exit.php" style="color: deepskyblue;">здесь</a>.<p>
            <?php endif; ?>


            <?php
            if (!empty($_COOKIE ['user'] == '')):
            ?>
            <div class="form_block">
                <h3 style="font-size: 20px;">Форма авторизации</h3>
                <?php
                if(isset($errors[0]) ) echo $errors[0];?>
                <form action="#" method="post">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"><br>
                    <button class="btn btn-success" type="submit" name="btn-in">Авторизоваться</button>
                </form>
            </div>
            <?php endif; ?>
        </body>
    </html>