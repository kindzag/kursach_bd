<?php
require_once("connect.php");



if(isset($_POST["delete"])){
    $id = $_POST["id"];
    $sql = "DELETE FROM departament WHERE id_departament = '$id'";

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
    <title>Удаление данных</title>
    <link rel="stylesheet" href="main/main.css">
</head>
<body>
    <h3 class="reg-text">Удаление данных</h3>
    <div class="input-data">
        <form method="post" action="departament_delete.php">
            <b>ID</b><br>
            <input type="text" name="id"><br>
            <br>

            <input type="submit" value="Удалить" name="delete"><br>
        </form>
    </div>
</body>
</html>