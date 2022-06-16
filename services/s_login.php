<?php
include './s_db.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];
$user = selectUserWhereEmail($email);
$hash = $user['password'];

if (password_verify($password, $hash)) {
    $_SESSION["name"] = $user['name'];
    $_SESSION["role"] = $user['role'];
    header("Location: ../index.php");
}
