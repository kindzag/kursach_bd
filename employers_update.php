<?php
require_once("connect.php");



if(isset($_POST["update"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $patronymic = $_POST["patronymic"];
    $id_departament = $_POST["id_departament"];
    $id_salary = $_POST["id_salary"];
    $sql = "UPDATE employess SET name = '$name', surname = '$surname', patronymic='$patronymic', id_departament='$id_departament', id_salary='$id_salary' WHERE ide = $id";

    if(mysqli_query($conn, $sql)){
        echo "<p>Успешно</p>";
    } else{
        echo "Ошибка";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>Изменение данных</title>
    <link rel="stylesheet" href="main/main.css">
</head>
<body>
    <h3 class="reg-text">Изменение данных</h3>
    <div class="input-data">
        <form method="post" action="employers_update.php">
            <b>ID</b><br>
            <input type="text" name="id"><br>
            <br>
            <b>Имя</b><br>
            <input type="text" name="name"><br>
            <br>
            <b>Фамилия</b><br>
            <input type="text" name="surname"><br>
            <br>
            <b>Отчество</b><br>
            <input type="text" name="patronymic"><br>
            <br>
            <b>ID отдела</b><br>
            <input type="text" name="id_departament"><br>
            <br>
            <b>ID зарплаты</b><br>
            <input type="text" name="id_salary"><br>
            <br>
            <input type="submit" value="Обновить" name="update"><br>
        </form>
    </div>
</body>
</html>