<?php
require_once("connect.php");


if(isset($_POST["senddata"])){
    $id = $_POST["id"];
    $sum_salary = $_POST["sum_salary"];
    $date_salary = $_POST["date_salary"];

    $errors = array();


    if(trim($id) == ''){
        $errors[] = "Укажите ID";
    }
    if(trim($sum_salary) == ''){
        $errors[] = "Укажите сумму зарплаты";
    }
    if(trim($date_salary) == ''){
        $errors[] = "Укажите дату зарплаты";
    }
    if(empty($errors)){
        $sql = "INSERT INTO salary (ids, sum_salary, date_salary) VALUES ('$id', '$sum_salary', '$date_salary');";
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
<form action="salary_insert.php" method="POST">
            <br><br>
            <input type="text" id="textInput" name="id" placeholder="ID сотрудника">
            <br><br>
            <input type="text" id="textInput" name="sum_salary" placeholder="Сумма зарплаты">
            <br><br>
            <input type="text" id="textInput" name="date_salary" placeholder="Дата зарплаты"><br>
            <br>
            <input type="submit" name="senddata" value="Отправить">
        </form>
</body>
</center>
</html>