<?php
    require_once '../lib/Common.php';
    require_once '../lib/DB.php';
    $common = new \lib\Common();
    $common->startSession();
    if (!$common->isUserLoggedIn()) {
        header('Location: ../index.php');
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["listingTitle"];
        $location = $_POST["destination"];
        $description = $_POST["description"];
        $rooms = $_POST["rooms"];
        $beds = $_POST["beds"];
        $amenities = isset($_POST['amenities']) ? json_encode($_POST['amenities']) : null;
        $price = $_POST["pricePerNight"];
        $publishedBy = $_SESSION["user_id"];

        $db = new \lib\DB();
        $db->createListing($name, $location, $description, $rooms, $beds, $amenities, $price, $publishedBy);

        header("Location: ../listings.php?listing=success");
        exit();
    } else {
        header("Location: ../create_listing.php");
        exit();
    }
?>