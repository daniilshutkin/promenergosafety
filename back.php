<?php
$errors = [];
$resText = '';

$views = json_decode(file_get_contents("views.json"));
$views->mail++;
file_put_contents('views.json', json_encode($views));

echo 'Количество посещений: '.$views->mail;
if (isset($_POST['mail'])) {
    
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);
    
    if (mb_strlen($name) < 5 || mb_strlen($name) > 30) {
        $errors[] = 'Не корректная длина имени (допустимо 5-30 символов)!';
    }elseif (mb_strlen($phone) < 17) {
        $errors[] = 'Не корректная длина номера телефона (должно быть 11 цифр)!';
    }elseif (mb_strlen($message) < 5 || mb_strlen($message) > 100) {
        $errors[] = 'Не корректная длина сообщения (допустимо 5-100 символов)!';
    }
    /*elseif (!preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/',$phone)) {
        $errors[] = 'Не корректный номер телефона! (Может начинаться с 8/+7 и содержать 11 цифр)';
    }*/
    
    if (empty($errors)) {
        $from = "Promenergoekb@gmail.com"; 
        $to = "Daniil24022002@gmail.com";
        $subject = $name.' / '.$phone; 
        $message = $message; 
        $headers = "From:" . $from;
        if (mail($to, $subject, $message, $headers)) {
            $resText = 'Сообщение успешно отправлено!';
        } else {
            $resText = 'Возникла ошибка при отправке!';
        }
        
        mail($to, $subject, $message, $headers);
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
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Промэнергобезопасность</title>
    <link rel="stylesheet" href="css/Design.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="feedback">
    <div class="wrapper" style="min-height: 15vh;">
        <div class="feedback">
            <?php
                if (!empty($resText)) {
                    echo '
                        <div class="result">
                        ' . $resText . '
                        </div>
                    ';
                }
            ?>
            <!--<div class="feedback__title"></div>-->
            <h3 style="font-size: 20px;">Сообщить об ошибке</h3>
            <?php
              if (!empty($errors)) {
                echo '
                   <div class="error">
                     ' . array_shift($errors) . '
                   </div>
                ';
              } 
              
            ?>
            <form method="post" action="#" class="feedback__form">
                <input name="name" type="text" class="form__input" placeholder="ФИО">
                <input name="phone" type="text" class="tel form__input" placeholder="Номер телефона">
                <textarea rows="4" name="message" type="text" class="form__input" placeholder="Сообщение"></textarea>
                <br>
                <button name="mail" type="submit" class="btn btn-success">Отправить</button>
            </form>
        </div>
    </div>
<script>
window.addEventListener("DOMContentLoaded", function() {
    [].forEach.call( document.querySelectorAll('.tel'), function(input) {
    var keyCode;
    function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___) ___ ____",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, ""),
            new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a
            });
        i = new_value.indexOf("_");
        if (i != -1) {
            i < 5 && (i = 3);
            new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
            function(a) {
                return "\\d{1," + a.length + "}"
            }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
        if (event.type == "blur" && this.value.length < 5)  this.value = ""
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false)

  });

});
</script>
<script src="//cdn.jsdelivr.net/npm/eruda"></script> <script>eruda.init();</script>
</body>
</html>