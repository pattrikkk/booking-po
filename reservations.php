<?php
    require_once 'lib/Common.php';
    require_once 'lib/DB.php';
    $common = new \lib\Common();
    $db = new \lib\DB();

    if (!$common->isUserLoggedIn()) {
        header('Location: index.php');
    }

    $reservations = $db->getReservations($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Level HTML Template by Tooplate</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
    <link rel="stylesheet" href="css/tooplate-style.css">
</head>

<body>
    <div class="tm-main-content" id="top">
        <?php include 'parts/nav.php'; ?>

        <div class="container">
            <?php $common->printAlerts(); ?>
            <div id="accordion">
                <?php foreach ($reservations as $reservation) { ?>
                    <?php
                        $listing = $db->getListing($reservation['listingId']);
                    ?>
                    <div class="card rounded my-5">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?= $listing['name'] ?>
                                </button>
                                <?php if (!$reservation['approved']) { ?>
                                    <span class="badge badge-danger">Not approved</span>
                                <?php } else { ?>
                                    <span class="badge badge-success">Approved</span>
                                <?php } ?>
                                <span class="badge badge-primary">Created at: <?= $reservation['createdAt'] ?></span>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <b>Your message: </b><?= $reservation['message'] ?>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="card-body">
                                        <b>From:</b> <?= $reservation['dateFrom'] ?>
                                        <b>To:</b> <?= $reservation['dateTo'] ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card-body">
                                        <b>Adults:</b> <?= $reservation['adults'] ?>
                                        <b>Children:</b> <?= $reservation['children'] ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card-body">
                                        <b>Price:</b> <?= $listing['price'] ?>€/night
                                    </div>
                                </div>
                            </div>
                            <a href="listing.php?id=<?= $listing['id'] ?>" class="btn btn-primary m-2" target="_blank">View listing</a>
                            <a href="reservations/delete_reservation.php?id=<?= $reservation['id'] ?>" class="btn btn-primary m-2">Delete</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php include 'parts/footer.php'; ?>
    </div>

    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script> <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script src="slick/slick.min.js"></script>

</body>

</html>