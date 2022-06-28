<?php
include $_SERVER['DOCUMENT_ROOT'] . '/services/s_db.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];
if (!empty($email)) {
    $user = selectUserWhereEmail($email);
    if (!empty($user)) {
        $hash = $user['password'];

        if (password_verify($password, $hash)) {
            $_SESSION["name"] = $user['name'];
            $_SESSION["role"] = $user['role'];
            header("Location: ../index.php");
        } else {
            $error = "Password was incorect.";
            $_SESSION['error'] = $error;
            header("Location: ../login.php");
        }
    }
} else {
    $error = "Email does not exist.";
    $_SESSION['error'] = $error;
    header("Location: ../login.php");
}
