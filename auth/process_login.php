<?php

require_once '../lib/DB.php';
use lib\DB;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $db = new \lib\DB();
    if (!$db->login($email, $password)) {
        header("Location: ../login.php?login=invalid_credentials");
        exit();
    }

    session_start();
    $_SESSION["email"] = $email;
    $_SESSION["firstName"] = $db->getFirstName($email);
    $_SESSION["lastName"] = $db->getLastName($email);
    $_SESSION["user_id"] = $db->getUserId($email);
    $_SESSION["loggedIn"] = true;

    header("Location: ../index.php?login=success");
    exit();
} else {
    header("Location: ../login.php");
    exit();
}