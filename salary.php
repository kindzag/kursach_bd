<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зарплата</title>
    <link rel="stylesheet" href="main/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
.btn-input{
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color: #ee2323;
    color: #fff;
    position: relative;
    font-size: 16px;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    padding: 0.5em 1em;
    transition: 0.5s;
    &:hover{
        box-shadow: 0 2px 25px rgba(235, 36, 46, 0.5);
    }
}
.table-info{
    text-align: center;
}
</style>
<body>
<div class="table-info">
        <table>
            <tr>
                <th>ID Сотрудника</th>
                <th>Сумма зарплаты</th>
                <th>Дата зарплаты</th>
            </tr>
            <?php
                require_once("connect.php");
                $sql = "SELECT ids, sum_salary, date_salary FROM salary";
                if($result = mysqli_query($conn, $sql)){
                while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo '<td>' . $row["ids"] . '</td>';
                echo '<td>' . $row["sum_salary"] . '</td>';
                echo '<td>' . $row["date_salary"]. '</td>';
                echo "</tr>";
            }
        }
?>
    </table>
    <br><br>
    <form action="salary_update.php" method="POST">
        <input type="submit" value="Изменить">
    </form>
    <br>
    <form action="salary_delete.php" method="POST">
        <input type="submit" value="Удалить">
    </form>
    <br>
    <form action="salary_insert.php" method="POST">
        <input type="submit" value="Добавить">
    </form>
    <br>
    <form action="find_salary.php" method="POST">
        <input type="submit" value="Поиск">
    </form>
</body>
</html>