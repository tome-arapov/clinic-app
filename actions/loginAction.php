<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:../views/login.php");
    die();
}
session_start();

require_once __DIR__."/../classes/DB.php";
require_once __DIR__."/../classes/User.php";
require_once __DIR__."/../classes/Validate.php";

use clinic\Validate;
use clinic\User;
$db = User::connect();



if (!Validate::emailValidation($_POST['email'])) {
    $_SESSION['error'] = "Enter a valid email address.";
    header("Location:../views/login.php");
    die();
}

$sql = "SELECT * FROM user WHERE email  = :email";
$stmt = $db->prepare($sql);
$stmt->execute(['email' => $_POST['email']]);
if ($stmt->rowCount() == 1) {
    $user = $stmt->fetch();
    if(!Validate::minChars(5,$_POST['password'])) {
        $_SESSION['error'] = "Password must be at least 5 characters.";
        header("Location:../views/login.php");
        die();
    }
    if (Validate::passwordVerification($_POST['password'], $user['password'])) {
        $_SESSION['email'] = $user['email'];
        header("Location:../views/dashboard.php");
        die();
    } else {
        $_SESSION['error'] = "Password incorrect.";
        header("Location:../views/login.php");
        die();
    }
} else {
    $_SESSION['error'] = "Wrong credentials.";
    header("Location:../views/login.php");
    die();
}  
