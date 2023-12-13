<?php
require_once '../lib/Common.php';
require_once '../lib/DB.php';
$common = new \lib\Common();
$db = new \lib\DB();
$common->startSession();
if (!isset($_GET['id'])) {
    header('Location: ../index.php');
}
$creator = $db->getCreatorOfListing($_GET['id']);
if (!$common->isUserLoggedIn()) {
    header('Location: ../index.php');
}
if ($_SESSION['user_id'] !== $creator['id']) {
    header('Location: ../index.php');
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $db = new \lib\DB();
    $db->deleteListing($id);
    header("Location: ../listings.php?listing=deleted");
    exit();
} else {
    header("Location: ../listings.php");
    exit();
}
?>