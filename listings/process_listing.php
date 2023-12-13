<?php
    require_once '../lib/Common.php';
    require_once '../lib/DB.php';
    $common = new \lib\Common();
    $common->startSession();
    if (!$common->isUserLoggedIn()) {
        header('Location: ../index.php');
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST["listingTitle"], ENT_QUOTES, 'UTF-8');
        $location = htmlspecialchars($_POST["destination"], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
        $rooms = filter_var($_POST["rooms"], FILTER_VALIDATE_INT);
        $beds = filter_var($_POST["beds"], FILTER_VALIDATE_INT);
        $amenities = isset($_POST['amenities']) ? json_encode($_POST['amenities']) : "[]";
        $price = filter_var($_POST["pricePerNight"], FILTER_VALIDATE_FLOAT);
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