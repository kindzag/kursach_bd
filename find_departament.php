<?php
require_once("connect.php");



if(isset($_POST['find'])){
    $id = $_POST["id"];
    $errors = array();
    if(trim($id) == ''){
        $errors[] = "Укажите id";
    }
    if(empty($errors)){
        $sql = "SELECT employess.ide , employess.name, employess.surname, employess.patronymic,employess.birthday, departament.id_departament , departament.named AS departament, salary.sum_salary FROM employess JOIN departament ON employess.id_departament = departament.id_departament JOIN salary ON employess.ide = salary.ids WHERE departament.id_departament = '$id'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<h5>Список сотрудников по отделу</h5>";
                echo "<table>";
                echo '<tr><th>ID Сотрудника</th><th>Имя</th><th>Фамилия</th><th>Отчество</th><th>Дата добавления</th><th>Номер отдела</th><th>Сумма зарплаты</th></tr>';
                while($row = mysqli_fetch_array($result)){
                    echo '<tr>';
                    echo '<td>' . $row["ide"] . '</td>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . $row["surname"] . '</td>';
                    echo '<td>' . $row["patronymic"] . '</td>';
                    echo '<td>' . $row["birthday"] . '</td>';
                    echo '<td>' . $row["id_departament"] . '</td>';
                    echo '<td>' . $row["sum_salary"] . '</td>';
                    echo '</tr>';
                }
                echo "</table>";
            }
            else{
                echo "<p>Такого отдела не существует!</p>";
            }
        }
        

    } else {
        echo '<div id="errorsmessage" style="color:red;text-align:center;font-size: 18px;margin-top:15px;">'.array_shift($errors).'</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск</title>
    <link rel="stylesheet" href="main/main.css">
</head>
<body>
<h3 class="reg-text">Поиск по ID отдела</h3>
    <div class="input-data">
        <form method="post" action="find_departament.php">
            <b>id</b><br>
            <input type="text" name="id"><br>
            <br>

            <input type="submit" value="Поиск" name="find"><br>
        </form>
    </div>
</body>
</html>