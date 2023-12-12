<?php
    require_once '../lib/Common.php';
    require_once '../lib/DB.php';
    $common = new \lib\Common();
    $db = new \lib\DB();
    $common->startSession();
    $creator = $db->getCreatorOfListing($_POST['id']);
    if (!$common->isUserLoggedIn()) {
        header('Location: ../index.php');
        exit();
    }
    if ($_SESSION['user_id'] !== $creator['id']) {
        header('Location: ../index.php');
        exit();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $name = $_POST["listingTitle"];
        $location = $_POST["destination"];
        $description = $_POST["description"];
        $rooms = $_POST["rooms"];
        $beds = $_POST["beds"];
        $amenities = isset($_POST['amenities']) ? json_encode($_POST['amenities']) : "[]";
        $price = $_POST["pricePerNight"];
        $publishedBy = $_SESSION["user_id"];
        $db->updateListing($id, $name, $location, $description, $rooms, $beds, $amenities, $price, $publishedBy);

        header("Location: ../listing.php?id=$id&listing=edited");
        exit();
    } else {
        header("Location: ../listings.php");
        exit();
    }
?>