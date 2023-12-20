<?php
    require_once 'lib/Common.php';
    require_once 'lib/DB.php';

    $common = new lib\Common();
    $db = new lib\DB();

    $common->startSession();


    $city = htmlspecialchars(isset($_GET["city"]) ? $_GET["city"] : "", ENT_QUOTES, 'UTF-8');
    $checkIn = htmlspecialchars(isset($_GET["check-in"]) ? $_GET["check-in"] : "", ENT_QUOTES, 'UTF-8');
    $checkOut = htmlspecialchars(isset($_GET["check-out"]) ? $_GET["check-out"] : "", ENT_QUOTES, 'UTF-8');

    $noAdults = filter_var(isset($_GET["noadults"]) ? $_GET["noadults"] : 0, FILTER_VALIDATE_INT);
    $noKids = filter_var(isset($_GET["nokids"]) ? $_GET["nokids"] : 0, FILTER_VALIDATE_INT);
    $noRooms = filter_var(isset($_GET["norooms"]) ? $_GET["norooms"] : 0, FILTER_VALIDATE_INT);
    
    $listingsByMe = isset($_GET["listings-by-me"]) ? true : false;

    $listings = $db->filterReservations($city, $checkIn, $checkOut, $noAdults, $noKids, $noRooms, $listingsByMe);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Listings</title>

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
            <div class="row mt-5">
                <div class="col-lg-3 mb-4">
                    <?php if ($common->isUserLoggedIn()) { ?>
                        <a class="btn btn-primary btn-block mb-3 text-white" href="create_listing.php">Create Listing</a>
                    <?php } ?>
                    <div class="card rounded">
                        <div class="card-body">
                            <form action="listings.php" method="get" class="tm-search-form">
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-100">
                                    <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                    <input name="city" type="text" class="form-control" id="inputCity"
                                        placeholder="Type your destination..." value="<?= $city ?>">
                                </div>
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-50">
                                    <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                    <input name="check-in" type="text" class="form-control" id="inputCheckIn"
                                        placeholder="Check In" value="<?= $checkIn ?>">
                                </div>
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-50">
                                    <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                    <input name="check-out" type="text" class="form-control" id="inputCheckOut"
                                        placeholder="Check Out" value="<?= $checkOut ?>">
                                </div>
                                        <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="noadults">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="noadults" class="form-control input-number" value=<?= $noAdults ?> min="0" max="10" id="noadults">
                                                <i class="fa fa-2x fa-user tm-form-element-icon tm-icon-number"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="noadults">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="nokids">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="nokids" class="form-control input-number" value=<?= $noKids ?> min="0" max="10" id="nokids">
                                                <i class="fa fa-user tm-form-element-icon tm-icon-number tm-form-element-icon-small"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="nokids">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="norooms">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="norooms" class="form-control input-number" value=<?= $noRooms ?> min="0" max="10" id="norooms">
                                                <i class="fa fa-2x fa-door-open tm-form-element-icon tm-icon-number"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="norooms">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-check pl-5">
                                            <input type="checkbox" id="listings-by-me" name="listings-by-me" class="form-check-input" <?= $listingsByMe ? "checked" : ""?>>
                                            <label class="form-check-label" for="listings-by-me">Listings by me</label>
                                        </div>
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                    <button type="submit" class="btn btn-primary tm-btn-search">Check
                                        Availability</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <?php foreach ($listings as $listing) { ?>
                        <div class="rounded bg-light p-3 mb-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php if (file_exists("img/listings/" . $listing['id'] . "/image_0.jpg")) { ?>
                                        <img src="img/listings/<?= $listing['id'] ?>/image_0.jpg" class="img-fluid img-medium rounded" alt="Listing Image">
                                    <?php } else { ?>
                                        <img src="placeholder.png" class="img-fluid img-medium rounded" alt="Listing Image">
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <div class="d-flex flex-column h-100">
                                        <h5 class="mt-0 mb-2 font-weight-bold"><?= $listing['name'] ?></h5>
                                        <p class="mb-1 font-weight-bold"><?= $listing['location'] ?></p>
                                        <p class="mb-1 text-truncate"><?= $listing['description'] ?></p>
                                        
                                        <!-- Display price on the left -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><?= $listing['price'] ?>€/night</h6>
                                            <a href="listing.php?id=<?= $listing['id'] ?>" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>

        <?php include 'parts/footer.php'; ?>
    </div>

    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script> <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>