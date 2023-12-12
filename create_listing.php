<?php
require_once 'lib/Common.php';
$common = new \lib\Common();
$common->startSession();
if (!$common->isUserLoggedIn()) {
    header('Location: index.php');
}
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

        <div class="container mt-3">
            <h1 class="mb-4">Create a Listing</h1>

            <!-- Listing Creation Form -->
            <form action="listings/process_listing.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="listingTitle">Listing Title:</label>
                            <input type="text" class="form-control" id="listingTitle" name="listingTitle" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mainImage">Main Image:</label>
                            <input type="file" class="form-control-file" id="mainImage" name="mainImage" accept="image/*" required>
                        </div>
                    </div>
                </div>

                <!-- Amenities Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group pl-4">
                            <label>Amenities:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="wifi" name="amenities[]" value="wifi">
                                <label class="form-check-label" for="wifi">Wi-Fi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="parking" name="amenities[]" value="parking">
                                <label class="form-check-label" for="parking">Parking</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="catering" name="amenities[]" value="catering">
                                <label class="form-check-label" for="catering">Catering</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="petsAllowed" name="amenities[]" value="petsAllowed">
                                <label class="form-check-label" for="petsAllowed">Pets Allowed</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beds">Number of Beds:</label>
                            <input type="number" class="form-control" id="beds" name="beds" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="rooms">Number of Rooms:</label>
                            <input type="number" class="form-control" id="rooms" name="rooms" min="1" required>
                        </div>
                    </div>
                </div>

                <!-- Location and Price Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destination">Destination:</label>
                            <input type="text" class="form-control" id="destination" name="destination" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pricePerNight">Price Per Night (€):</label>
                            <input type="number" class="form-control" id="pricePerNight" name="pricePerNight" min="0" step="0.01" required>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter your listing description" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create Listing</button>
            </form>
            <!-- End Listing Creation Form -->
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
    <script src="js/script.js"></script>
    <script src="js/calendar.js"></script>

</body>

</html>