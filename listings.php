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
            <div class="row mt-5">
                <div class="col-lg-3 mb-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <form action="index.php" method="get" class="tm-search-form">
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-100">
                                    <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                    <input name="city" type="text" class="form-control" id="inputCity"
                                        placeholder="Type your destination...">
                                </div>
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-50">
                                    <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                    <input name="check-in" type="text" class="form-control" id="inputCheckIn"
                                        placeholder="Check In">
                                </div>
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-50">
                                    <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                    <input name="check-out" type="text" class="form-control" id="inputCheckOut"
                                        placeholder="Check Out">
                                </div>
                                        <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="quant[1]" class="form-control input-number" value="0" min="0" max="10" id="noadults">
                                                <i class="fa fa-2x fa-user tm-form-element-icon tm-icon-number"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[2]">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="quant[2]" class="form-control input-number" value="0" min="0" max="10" id="nokids">
                                                <i class="fa fa-user tm-form-element-icon tm-icon-number tm-form-element-icon-small"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[2]">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[3]">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="quant[3]" class="form-control input-number" value="0" min="0" max="10" id="norooms">
                                                <i class="fa fa-2x fa-door-open tm-form-element-icon tm-icon-number"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[3]">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                <div class="form-group tm-form-element tm-form-element-listing tm-form-element-2">
                                    <button type="submit" class="btn btn-primary tm-btn-search">Check
                                        Availability</button>
                                </div>
                                <div class="form-row clearfix pl-2 pr-2 tm-fx-col-xs">
                                    <p class="tm-margin-b-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                    <a href="#"
                                        class="ie-10-ml-auto ml-auto mt-1 tm-font-semibold tm-color-primary">Need
                                        Help?</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="rounded bg-light p-3 mb-4">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="placeholder.png" class="img-fluid rounded" alt="Listing Image">
                            </div>
                            <div class="col-sm-8">
                                <div class="d-flex flex-column h-100">
                                    <h5 class="mt-0 mb-2 font-weight-bold">Listing Title</h5>
                                    <p class="mb-1 font-weight-bold">Bratislava, Slovensko</p>
                                    <p class="mb-3">A brief description of the listing to provide more information about
                                        what it offers to users.</p>
                                    <div class="ml-auto">
                                        <a href="listing.php" class="btn btn-primary">View Details</a>
                                    </div>
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
    <script src="slick/slick.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>