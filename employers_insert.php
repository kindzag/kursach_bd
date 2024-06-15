<?php
require_once("connect.php");
if(isset($_POST['senddata'])){
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $patronymic = $_POST["patronymic"];
    $name_departament = $_POST["name_departament"];
    $sum_salary = $_POST["sum_salary"];
    $errors = array();
    if(trim($name) == ''){
        $errors[] = "Укажите имя!";
    }
    if(trim($surname) == ''){
        $errors[] = "Укажите фамилию!";
    }
    if(trim($name_departament) == ''){
        $errors[] = "Укажите название отдела!";
    }
    if(trim($patronymic) == ''){
        $errors[] = "Укажите отчество!";
    }
    if(empty($errors)){
        $date = date('Y-m-d H:i:s');
        $sql = "SELECT id_departament FROM departament WHERE named = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $name_departament);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 0){
            // Вставка нового отдела
            $sql = "INSERT INTO departament (named) VALUES (?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $name_departament);
            mysqli_stmt_execute($stmt);
            $departament_id = mysqli_insert_id($conn);
        } else {
            $row = mysqli_fetch_assoc($result);
            $departament_id = $row['id_departament'];
        }

        // Проверка наличия зарплаты
        $sql = "SELECT ids FROM salary WHERE sum_salary = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $sum_salary);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 0){
            // Вставка новой зарплаты
            $sql = "INSERT INTO salary (sum_salary) VALUES (?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $sum_salary);
            mysqli_stmt_execute($stmt);
            $salary_id = mysqli_insert_id($conn);
        } else {
            $row = mysqli_fetch_assoc($result);
            $salary_id = $row['ids'];
        }

        // Вставка сотрудника
        $sql = "INSERT INTO employess (name, surname, patronymic, birthday, id_departament, id_salary) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssii', $name, $surname, $patronymic, $date, $departament_id, $salary_id);
        if(mysqli_stmt_execute($stmt)){
            echo "Сотрудник успешно добавлен";
        } else{
            echo "Ошибка при добавлении сотрудника: " . mysqli_error($conn);
        }
    } else{
        echo '<div id="errorsmessage" style="color:red;text-align:center;font-size: 18px;margin-top:15px;">'.array_shift($errors).'</div>';
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить данные</title>
    <link rel="stylesheet" href="main/main.css">
</head>
<body>
<center>
<form action="employers_insert.php" method="POST">
            <br><br>
            <input type="text" id="textInput" name="name" placeholder="Имя">
            <br><br>
            <input type="text" id="textInput" name="surname" placeholder="Фамилия">
            <br><br>
            <input type="text" id="textInput" name="patronymic" placeholder="Отчество">
            <br><br>
            <input type="text" id="textInput" name="name_departament" placeholder="Название отдела">
            <br><br>
            <input type="text" id="textInput" name="sum_salary" placeholder="Сумма зарплаты">
            <br><br>
            <input type="submit" name="senddata" value="Отправить">
        </form>
</body>
</center>
</html>