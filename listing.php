<?php
require_once 'lib/Common.php';
require_once 'lib/DB.php';

$common = new \lib\Common();
$common->startSession();

$db = new \lib\DB();

if (isset($_GET['id'])) {
    $listing = $db->getListing($_GET['id']);
    $reservations = $db->getListingReservations($_GET['id']);
    $amenities = json_decode($listing['amenities']);

    $creator = $db->getCreatorOfListing($_GET['id']);
    $creatorName = $creator['firstName'] . " " . $creator['lastName'];
    $creatorPhone = $creator['phone'];

    $images = scandir('img/listings/' . $listing['id']);
    $images = array_filter($images, function ($image) {
        return $image !== '.' && $image !== '..' && $image !== 'image_0.jpg';
    });
} else {
    header('Location: listings.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $listing['name'] ?></title>

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

        <div class="container mt-3">
            <?php $common->printAlerts(); ?>
            <h1><?= $listing["name"]?></h1>
            <div class="row">
                <!-- Main Image Section -->
                <div class="col-md-8">
                    <img src="img/listings/<?=$listing['id']?>/image_0.jpg" class="img-fluid img-large rounded mb-4" alt="Listing Image">
                </div>
    
                <!-- Side Images Section -->
                <div class="col-md-4">
                    <div class="row">
                        <?php foreach ($images as $image) { ?>
                            <div class="col-6">
                                <img src="img/listings/<?=$listing['id']?>/<?=$image?>" class="img-fluid img-small rounded mb-2" alt="Side Image 1">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row bg-light rounded m-1 py-4">
                <div class="col-md-2 col-3 py-2">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                        <i class="fa fa-wifi fa-2x my-auto"></i>
                        <p class="mb-auto"><?php echo in_array("wifi", $amenities) ? "Wi-Fi" : "No Wi-Fi" ?></p>
                    </div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                        <i class="fa fa-paw fa-2x my-auto"></i>
                        <p class="mb-auto"><?php echo in_array("petsAllowed", $amenities) ? "Pets allowed" : "Pets not allowed" ?></p>
                    </div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                        <i class="fa fa-parking fa-2x my-auto"></i>
                        <p class="mb-auto"><?php echo in_array("parking", $amenities) ? "Parking in the area" : "No parking  in the area" ?></p>
                    </div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                        <i class="fa fa-utensils fa-2x my-auto"></i>
                        <p class="mb-auto"><?php echo in_array("catering", $amenities) ? "Catering is included in the price" : "Catering is not included in the price" ?></p>
                    </div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                        <i class="fa fa-bed fa-2x my-auto"></i>
                        <p class="mb-auto"><?= $listing["beds"] ?> beds</p>
                    </div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                        <i class="fa fa-door-open fa-2x my-auto"></i>
                        <p class="mb-auto"><?= $listing["rooms"] ?> rooms</p>
                    </div>
                </div>

            </div>
            <div class="row my-3">
                <div class="col-md-8 mb-3">
                    <h2>Description</h2>
                    <p><?= $listing["description"]?></p>
                </div>
                <div class="col-md-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5 class="card-title"><?= $creatorName ?></h5>
                            <p class="card-text"><?= $creatorPhone ?></p>
                            <p class="card-text"><small class="text-muted">Published on: <?= $listing["publishedDate"] ?></small></p>
                            <a href="#" class="btn btn-primary w-100">Contact</a>
                                <?php if ($common->isUserLoggedIn() && $listing['publishedBy'] === $_SESSION['user_id']) { ?>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <a href="manage_reservations.php?id=<?= $listing['id'] ?>" class="btn btn-primary w-100 mb-2">Manage reservations</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="listings/delete_listing.php?id=<?= $listing['id'] ?>" class="btn btn-primary w-100">Delete listing</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="update_listing.php?id=<?= $listing['id'] ?>" class="btn btn-primary w-100">Update listing</a>
                                        </div>
                                    </div>
                                <?php } ?> 
                        </div>              
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 my-3">
                    <form class="border rounded p-4">
                        <input type="hidden" name="listingId" id="inputListingId" value="<?= $listing["id"] ?>">
                        <h2 class="text-center mb-4">Reservation Form</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="arrival">Arrival:</label>
                                    <input type="date" class="form-control" name="dateFrom" id="dateFrom">
                                </div>
                            </div>
                            <div class=" col-lg-6">
                                <div class="form-group">
                                    <label for="departure">Departure:</label>
                                    <input type="date" class="form-control" name="dateTo" id="dateTo">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputAdults">Number of adults:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="adults">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                        </span>
                                        <input type="number" name="adults" class="form-control input-number" value="1" min="1" max="10" id="inputAdults">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="adults">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputChildren">Number of kids:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="kids">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                        </span>
                                        <input type="number" name="kids" class="form-control input-number" value="0" min="0" max="10" id="inputChildren">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="kids">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="textarea">Message:</label>
                            <textarea class="form-control" name="message" id="inputMessage" rows="4" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="alert"></div>
                                <?php if ($common->isUserLoggedIn()) { ?>
                                    <input type="button" onClick="sendReservation()" class="reservationButton btn btn-primary w-100" value="Submit"/>
                                <?php } else { ?>
                                    <a href="login.php" class="btn btn-primary w-100">Login to submit</a>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 my-3">
                    <div class="calendar border rounded p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center mb-4">Reservations Calendar</h2>
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <button class="btn btn-primary" onclick="prevMonth()"><</button>
                                    </div>
                                    <div class="col text-center">
                                        <h4 id="currentMonth"></h4>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-primary" onclick="nextMonth()">></button>
                                    </div>
                                </div>
                                <div id="calendar" class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                        </tr>
                                        </thead>
                                        <tbody id="calendar-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script src="slick/slick.min.js"></script>
    <script>
        let reservations = <?= json_encode($reservations) ?>;

        function sendReservation() {
            console.log("clicked");
            $.ajax({
                url: 'reservations/create_reservation.php',
                type: 'POST',
                data: {
                    'dateFrom': $('#dateFrom').val(),
                    'dateTo': $('#dateTo').val(),
                    'adults': $('#inputAdults').val(),
                    'kids': $('#inputChildren').val(),
                    'listingId': $('#inputListingId').val(),
                    'message': $('#inputMessage').val()
                },
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    if (data["type"] == "success") {
                        window.location.href = "reservations.php?reservation=success";
                        return;
                    }
                    if($('#alert').children().length > 0) {
                        $('#alert').children().remove();
                    }
                    $('#alert').append('<div class="alert rounded alert-'+ data["type"] +'" role="alert">'+data["message"]+'</div>');
                }
            });
        }
    </script>
    <script src="js/calendar.js"></script>
    <script src="js/script.js"></script>

</body>

</html>