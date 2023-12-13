<?php

require_once '../lib/Common.php';
require_once '../lib/DB.php';
$common = new \lib\Common();
$common->startSession();
if (!$common->isUserLoggedIn()) {
    header('Location: ../index.php');
}
$db = new \lib\DB();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $reservationId = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if (!$db->checkReservationOwner($reservationId, $_SESSION['user_id'])) {
        header('Location: ../reservations.php');
        exit();
    }

    $db->deleteReservation($reservationId);
    header('Location: ../reservations.php?reservation=deleted');
    exit();
} else {
    header('Location: ../reservations.php');
    exit();
}

?>