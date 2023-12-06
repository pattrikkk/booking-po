<?php
require_once '../lib/DB.php';
use lib\DB;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $pnumber = $_POST["pnumber"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    if ($password != $cpassword) {
        header("Location: ../register.php?registration=password_mismatch");
        exit();
    }
    $db = new \lib\DB();
    if ($db->emailExists($email)) {
        header("Location: ../register.php?registration=email_exists");
        exit();
    }
    $db->register($fname, $lname, $email, $password, $pnumber);
    header("Location: ../login.php?registration=success");
    exit();
} else {
    header("Location: ../register.php");
    exit();
}
?>