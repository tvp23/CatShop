<?php
include './s_db.php';
session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

function removeSpecialChar($str)
{
    $res = preg_replace('/[\;\#\<\>\?\/\(\)]+/', '', $str);
    return $res;
}

function emailValidation($email)
{
    $ok = false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ok = true;
    }
    return $ok;
}

function nameValidation($name)
{
    $ok = false;
    if (strlen($name) > 3) {
        $ok = true;
    }
    return $ok;
}

function passwordValidation($password)
{
    $ok = false;
    if (strlen($password) > 8) {
        $specChars = '/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/';
        if (preg_match($specChars, $password)) {
            $numChars = '/[0-9]/';
            if (preg_match($numChars, $password)) {
                if (preg_match('/[A-Z]/', $password)) {
                    $ok = true;
                }
            }
        }
    }
    return $ok;
}

$sanName = removeSpecialChar($name);
$error = [];
if (!empty(selectUserWhereEmail($email)))
    array_push($error, 0);
if (!emailValidation($email))
    array_push($error, 1);
if (!nameValidation($sanName))
    array_push($error, 2);
if (!passwordValidation($password))
    array_push($error, 3);

if (count($error) == 0) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    insertUser($sanName, $email, $hash, 'user');

    $_SESSION["name"] = $name;
    $_SESSION["role"] = 'user';
    header("Location: ../index.php");
} else {
    $_SESSION['error'] = $error;
    header("Location: ../register.php");
}
