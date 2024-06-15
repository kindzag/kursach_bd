<?php

require_once("connect.php");
session_start();
function generateSalt()
{
    $salt = '';
    $saltLength = 8;
    for($i = 0; $i < $saltLength; $i++){
        $salt .= chr(mt_rand(33, 126));
    }
    return $salt;
}





if(isset($_POST['do_singup']))
{
    $login = $_POST["login"];
    $email = $_POST["email"];
    $salt = generateSalt();
    $password = md5($salt. $_POST["password"]);
    $errors = array();
    if(trim($login) == '')
    {
        $errors[] = 'Введите логин!';
    }
    if(trim($email) == '')
    {
        $errors[] = 'Введите Email!';
    }
    if(trim($password) == '')
    {
        $errors[] = 'Введите пароль';
    }
    if(trim(mb_strlen($password) < 3) || trim(mb_strlen($password) > 32))
    {
        $errors[] = 'Пароль не может быть меньше 3х символов и больше 32х';
    }
    if(trim(mb_strlen($email) < 6) || trim(mb_strlen($email) > 32))
    {
        $errors[] = 'Длина почты не может быть меньше 6ти и больше 32х символов';
    }
    if(trim(mb_strlen($login) < 3) || trim(mb_strlen($login) > 32))
    {
        $errors[] = 'Длина логина не может быть меньше 3х и больше 32х символов';
    }
    $query = "SELECT * FROM accounts WHERE login='$login'";
    $result = mysqli_query($conn, $query);

    $query_email = "SELECT * FROM accounts WHERE email='$email'";
    $email_query = mysqli_query($conn, $query_email);
    $email_download = mysqli_fetch_assoc($email_query);
    $user = mysqli_fetch_assoc($result);

    if($login == $user['login']){
        $errors[] = "Данный логин уже занят";
    }
    if($email == $user['email']){
        $errors[] = "Данная почта уже используется!";
    }
    $date = date('Y-m-d H:i:s');
    if(empty($errors))
    {
        $sql = "INSERT INTO accounts (login, password,salt,email, date_reg) VALUES ('$login',
        '$password','$salt','$email', '$date')";

        $result = mysqli_query($conn, $sql);
        setcookie("login", $login, time() + 3600 * 30, '/');
        setcookie("email", $email, time() + 3600 * 30, '/');
        $_SESSION["login"] = $login;
        header("Location: auth.php");
    } else{
        echo '<div id="errorsmessage" style="color:red;text-align:center;font-size: 18px;margin-top:15px;">'.array_shift($errors).'</div>';
    }
}







?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="main/main.css">
    
</head>
<body>
    <?php
        if(isset($_SESSION['login'])){
            header("Location: auth.php");
        }
        if(isset($_SESSION['auth']) == 'YES'){
            echo "<nav>";
            echo "<ul style='display:flex; list-style:none;'>";
            echo "<li style='margin-right:20px;'><a href='myprofile.php' style='text-decoration: none;'>Мой профиль</a></li>";
            echo "<li><a href='exit.php' style='text-decoration: none;'>Выход</a></li>";
            echo "</ul>";
            echo "</nav>";
        }
        else {
            echo "<h3 class='reg-text'>Регистрация</h3>";
            echo "<div class='input-data'>";
            echo    "<form method='post' action='index.php'>";
            echo    "<input type='text' name='login' placeholder='Логин'><br>";
            echo    "<br>";
            echo    "<input type='text' name='email' placeholder='Email'><br>";
            echo    "<br>";
            echo    "<input type='text' name='password' placeholder='Пароль'><br>";
            echo    "<br>";
            echo    "<input type='submit' name='do_singup' value='Отправить'><br>";
            echo    "<br>";
            echo "<p>Зарегистрированы? Выполните <a href='auth.php'>вход</a></p>";
            echo "</form>";
            echo "</div>";
        }
    ?>
    <script src="main/main.js"></script>
</body>
</html>