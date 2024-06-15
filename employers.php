<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудники</title>
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
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th>Дата добавления</th>
                <th>ID отдела</th>
                <th>Название отдела</th>
                <th>Зарплата</th>
            </tr>
            <?php
                require_once("connect.php");
                $sql = "SELECT employess.ide , employess.name, employess.surname, employess.patronymic,employess.birthday, departament.id_departament , departament.named 
                AS departament, salary.sum_salary 
                FROM employess 
                JOIN departament 
                ON employess.id_departament = departament.id_departament JOIN salary ON employess.ide = salary.ids";
                if($result = mysqli_query($conn, $sql)){
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo '<td>' . $row["ide"] . '</td>';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . $row["surname"] . '</td>';
                        echo '<td>' . $row["patronymic"] . '</td>';
                        echo '<td>' . $row["birthday"] . '</td>';
                        echo '<td>' . $row["id_departament"] . '</td>';
                        echo '<td>' . $row["departament"] . '</td>';
                        echo '<td>' . $row["sum_salary"] . '</td>';
                        echo "</tr>"; 
                    }
                }
            ?>
        </table>
        <br> <br>
        <script>
            $('#showFormBtn').click(function(){
                $('#inputForm').toggle();
                $('#deletedatae').toggle();
        });
        $('#showformdlte').click(function(){
            $('#inputdeletee').toggle();
        });
        $(document).ready(function(){
        $('#inputForm').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'employers_insert.php',
                data: formData,
                success: function(response){
                    alert(response);
                },
                error: function(xhr, status, error){
                    console.log(xhr.responseText);
                }
            });
        });
    });
        </script>
       
       <form action="employers_insert.php">
            <input type="submit" value="Добавить">
        </form>
        
        <br><br>
        <form action="employers_delete.php">
            <input type="submit" value="Удалить">
        </form>
        <br><br>
        <form action="employers_update.php">
            <input type="submit" value="Изменить">
        </form>
</div>
<script src="js/main.js"></script>
</body>
</html>