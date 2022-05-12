<?php
  require_once 'config/connect.php';

  $technic_id = $_GET['id'];
  $technic = mysqli_query($connect,"SELECT * FROM `technic` WHERE `id` = '$technic_id'");
  $technic = mysqli_fetch_assoc($technic);
$errors = [];
if (isset($_POST['update'])) {
  
  $departament = $_POST['departament'];
  $category = $_POST['category'];
  $inventory = $_POST['inventory'];
  $title = $_POST['title'];
  
  $departamentLen = mb_strlen(trim($_POST['departament'])) ;
  $categoryLen = mb_strlen(trim($_POST['category'])) ;
  $inventoryLen = mb_strlen(trim($_POST['inventory'])) ;
  $titleLen = mb_strlen(trim($_POST['title'])) ;
  if ($departamentLen > 50) {
    $errors['departament'] = 'Введите не более 50 символов';
  }elseif ($departamentLen < 1) {
    $errors['departament'] = 'Введите не менее 1 символа';
  }elseif ($departamentLen > 0 and !preg_match('/[^0-9]/', $departament)) {
    $errors['departament'] = 'Поле не может состоять только из цифр';
  }elseif($departamentLen > 0 and preg_match("/[A-Za-z!@#$%^&*(:)№;?~`<>'{}()|\/<>]/iu", $departament)){
    $errors['departament'] = 'Поле может содержать только кириллицу или цифры';
  } 

  if ($categoryLen > 20) {
    $errors['category'] = 'Введите не болеее 20 символов';
  }elseif ($categoryLen < 1) {
    $errors['category'] = 'Введите не менее 1 символа';
  }elseif ($categoryLen > 0 and !preg_match('/[^0-9]/', $category)) {
    $errors['category'] = 'Поле не может состоять только из цифр';
  }elseif($categoryLen > 0 and preg_match("/[A-Za-z!@#$%^&*(:)№;?~`<>'{}()|\/<>]/iu", $category)){
    $errors['category'] = 'Поле может содержать только кириллицу или цифры'; 
  }
  
  if ($inventoryLen < 1) {
    $errors['inventory'] = 'Введите не менее 1 символа';
  }elseif ($inventoryLen > 5) {
    $errors['inventory'] = 'Введите не более 5 символов';
  }
  
  if ($titleLen > 50) {
    $errors['title'] = 'Введите не болеее 50 символов';
  }elseif ($titleLen < 1) {
    $errors['title'] = 'Введите не менее 1 символа';
  }elseif ($titleLen > 0 and !preg_match('/[^0-9]/', $title)) {
    $errors['title'] = 'Поле не может состоять только из цифр';
  }elseif($titleLen > 0 and preg_match("/[А-Яа-я!@#$%^&*(:)№;?~`<>'{}()|\/<>]/iu", $title)){
    $errors['title'] = 'Поле может содержать только латинские буквы или цифры'; 
  }
  
  if (empty($errors)) {
    mysqli_query($connect,"UPDATE `technic` SET `departament` = '$departament', `category` = '$category', `inventory` = '$inventory', `title` = '$title' WHERE `id` = '$technic_id'");
    header('Location: index.php');
  }


}
?>

<DOCTUPE HTML!>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Промэнергобезопасность</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <h1><img src="css/peb.png" width="177" height="123" align="middle">Промэнергобезопасность</h1>
        <ul>
            <li><a href="index.php">База данных</a></li>
        </ul>
    </body>
</html>  

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Обновить технику</title>
</head>
<body class="update">
    <div class="block">
  <h3>Обновить технику</h3>
    <form action="#" method="post">
      <input type="hidden" name="id" value="<?= $technic['id']?>">
      <p>Отдел</p>
      <?php if(!empty($errors['departament']))echo $errors['departament'];?>
      <textarea name="departament"><?= $technic['departament']?></textarea>
            <br>
            <br>
      <p>Категория</p>
      <?php if(!empty($errors['category']))echo $errors['category'];?>
      <input type="text" name="category" value="<?= $technic['category']?>">
            <br>
      <p>Инвентарный номер</p>
      <?php if(!empty($errors['inventory']))echo $errors['inventory'];?>
      <input type="number" name="inventory" value="<?= $technic['inventory']?>">
            <br>
      <p>Название</p>
      <?php if(!empty($errors['title']))echo $errors['title'];?>
      <textarea name="title"><?= $technic['title']?></textarea>
      <br>
            <br>
      <button name="update" type="submit">Обновить технику</button>
    </form>
     </div>
</body>
</html>