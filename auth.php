<?php
require_once("connect.php");
session_start();


if(isset($_POST['do_auth'])){
    $login = $_POST["login"];
    $password_user = $_POST["password"];

    $success = array();
    $errors = array();
    if(trim($login) == '')
    {
        $errors[] = 'Введите логин!';
    }
    if(trim($password_user) == '')
    {
        $errors[] = 'Введите пароль';
    }
    

    $query = "SELECT *FROM accounts WHERE login='$login'";
    $res = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($res);

    if(!empty($user)){
        $salt = $user['salt'];
        $hash = $user['password'];
        $password = md5($salt . $_POST['password']);
        if($password == $hash){
        if(empty($errors)){
            unset($_SESSION["login"]);
                echo '<div style="color:green;text-align:center;font-size: 18px;">'.array_shift($success).'</div>';
            $_SESSION["auth"] = "YES";
            header("Location: index.php");
            }else{
                echo '<div style="color:red;text-align:center;font-size: 18px;">'.array_shift($errors).'</div>';
            }
        } else {
            $errors[] = "Неверный пароль";
        } 

    } else {
        $errors[] = "Пользователя с таким логином не существует!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="main/main.css">
</head>
<body>
    <h3 class="reg-text">Авторизация</h3>
    <div class="input-data">
        <form method="post" action="auth.php">
            <input type="text" name="login" placeholder='Логин'><br>
            <br>
            <input type="text" name="password" placeholder='Пароль'><br>
            <br>
            <input type="submit" name="do_auth" value="Отправить"><br>
        </form>
    </div>
</body>
</html>