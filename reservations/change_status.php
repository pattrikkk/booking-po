<?php
    require_once '../lib/Common.php';
    require_once '../lib/DB.php';
    $common = new \lib\Common();
    $db = new \lib\DB();

    $common->startSession();

    if (!$common->isUserLoggedIn()) {
        header('Location: index.php');
    }

    if (!isset($_GET['id'])) {
        header('Location: index.php');
    }

    $listingId = $db->getListingFromReservationID($_GET['id'])['id'];
    $creator = $db->getCreatorOfListing($listingId);
    if ($creator['id'] !== $_SESSION['user_id']) {
        header('Location: index.php');
    }

    if (isset($_GET['status'])) {
        $status = filter_var($_GET['status'], FILTER_VALIDATE_INT);
        $db->changeReservationStatus($_GET['id'], $status);
        header('Location: ../manage_reservations.php?id=' . $listingId);
    }