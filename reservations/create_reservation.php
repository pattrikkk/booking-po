<?php

require_once '../lib/Common.php';
require_once '../lib/DB.php';
$common = new \lib\Common();
$common->startSession();
if (!$common->isUserLoggedIn()) {
    header('Location: ../index.php');
}
$db = new \lib\DB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION["user_id"];
    $listingId = filter_var($_POST["listingId"], FILTER_VALIDATE_INT);
    $dateFrom = htmlspecialchars($_POST["dateFrom"], ENT_QUOTES, 'UTF-8');
    $dateTo = htmlspecialchars($_POST["dateTo"], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
    $adults = filter_var($_POST["adults"], FILTER_VALIDATE_INT);
    $children = filter_var($_POST["kids"], FILTER_VALIDATE_INT);


    if ($db->checkReservationOverlap($listingId, $dateFrom, $dateTo)) {
        $encodedData = json_encode($common->getAlert("reservation", "overlap"));
        echo $encodedData;
        exit();
    }

    if ($dateFrom >= $dateTo) {
        $encodedData = json_encode($common->getAlert("reservation", "invalidDates"));
        echo $encodedData;
        exit();
    }

    if ($db->createReservation($userId, $listingId, $dateFrom, $dateTo, $message, $adults, $children)) {
        $encodedData = json_encode($common->getAlert("reservation", "success"));
        echo $encodedData;
        exit();
    }
} else {

}

?>