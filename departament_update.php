<?php
require_once("connect.php");

$id = $_POST["id"];
$name_departament = $_POST["name_departament"];
$num_employess = $_POST["num_employess"];
$num_managerd = $_POST["num_managerd"];
$errors = array();


if(trim($id) == ''){
    $errors[] = "Укажите ID";
}
if(trim($name_departament) == ''){
    $errors[] = "Укажите название отдела";
}
if(trim($num_employess) == ''){
    $errors[] = "Укажите количество сотрудников";
}
if(trim($num_managerd) == ''){
    $errors[] = "Укажите количество менеджеров";
}
if(empty($errors)){
    $sql = "UPDATE departament SET named = '$name_departament', num_employess = '$num_employess', managerd = '$num_managerd' WHERE id_departament = '$id'";
    if(mysqli_query($conn, $sql)){
        echo "Данный успешно обновлены";
    } else {
        echo "Ошибка при обновлении данных: " . mysqli_error($conn);
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main/main.css">
</head>
<body>
<center>
<form action="departament_update.php" method="POST">
            <br><br>
            <input type="text" id="textInput" name="id" placeholder="Номер отдела">
            <br><br>
            <input type="text" id="textInput" name="name_departament" placeholder="Название отдела">
            <br><br>
            <input type="text" id="textInput" name="num_managerd" placeholder="Количество менеджеров">
            <br><br>
            <input type="text" id="textInput" name="num_employess" placeholder="Количество работников"><br>
            <br><br>
            <input type="submit" name="senddata" value="Отправить">
        </form>
</center>
</body>
</html>