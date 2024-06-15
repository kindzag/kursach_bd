<?php

require_once("connect.php");

$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["password"];

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

if(empty($errors))
{
    $sql = "INSERT INTO accounts (login, password, email) VALUES ('$login',
    '$email', '$password')";

    $result = mysqli_query($conn, $sql);
    header("Location: auth.html");
} else{
    echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
}
/*
if(empty($login) || empty($email) || empty($password)){
    echo "Заполните все поля";
    exit();
}

if(mb_strlen($login) < 5 || mb_strlen($login) > 32){
    echo "Логин не может быть меньше 5-ти и больше 32х символов";
    exit();
}
if(mb_strlen($email) < 6 || mb_strlen($email) > 34){
    echo "Длина Email'a не может быть меньше 6-ти и больше 34х символов";
    exit();
}
if(mb_strlen($password) < 6 || mb_strlen($password) > 32){
    echo "Длина пароля не может быть меньше 6-ти и больше 32х символов";
    exit();
}
$query = mysqli_query($conn, "SELECT id FROM accounts WHERE login='".mysqli_real_escape_string($conn, $_POST['login'])."'");
if(mysqli_num_rows($query) > 0){
    echo "Пользователь с таким логином уже существует!";
    exit();
}
$query_email = mysqli_query($conn, "SELECT id FROM accounts WHERE email='".mysqli_real_escape_string($conn, $_POST['email'])."'");
if(mysqli_num_rows($query_email) > 0){
    echo "Данная почта уже занята";
    exit();
}
*/




?>


?>