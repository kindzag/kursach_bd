<?php
require_once("connect.php");


if(isset($_POST["senddata"])){
    $id = $_POST["id"];
    $name_departament = $_POST["name_departament"];
    $num_employess = $_POST["num_employess"];
    $num_managerd = $_POST["num_managerd"];

    $errors = array();


    if(trim($id) == ''){
        $errors[] = "Укажите ID";
    }
    if(trim($name_departament) == ''){
        $errors[] = "Укажите сумму зарплаты";
    }
    if(trim($num_employess) == ''){
        $errors[] = "Укажите дату зарплаты";
    }
    if(trim($num_managerd) == ''){
        $errors[] = "Укажите количество менеджеров";
    }
    if(empty($errors)){
        $sql = "INSERT INTO departament (id_departament, named, num_employess, managerd) VALUES ('$id', '$name_departament', '$num_employess', '$num_managerd')";
        if(mysqli_query($conn, $sql)){
            echo "Данный успешно добавлены";
        } else {
            echo "Ошибка при обновлении данных: " . mysqli_error($conn);
        }
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
<form action="departament_insert.php" method="POST">
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
</body>
</center>
</html>