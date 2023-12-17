<?php
require_once 'lib/Common.php';
$common = new \lib\Common();
$common->startSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Booking</title>


<!--

Tooplate 2095 Level

https://www.tooplate.com/view/2095-level

-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

    <body>
        <div class="tm-main-content" id="top">
            <?php include 'parts/nav.php'; ?>
            <div class="tm-section tm-bg-img" id="tm-section-1">
                <div class="tm-bg-white ie-container-width-fix-2 rounded">
                    <div class="container ie-h-align-center-fix">
                        <div class="row">
                            <div class="col-xs-12 ml-auto mr-auto ie-container-width-fix">
                                <form action="listings.php" method="get" class="tm-search-form tm-section-pad-2">
                                    <div class="form-row tm-search-form-row">
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                            <input name="city" type="text" class="form-control" id="inputCity" placeholder="Type your destination...">
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                            <input name="check-in" type="text" class="form-control calendar" id="inputCheckIn" placeholder="Check In">
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                            <input name="check-out" type="text" class="form-control calendar" id="inputCheckOut" placeholder="Check Out">
                                        </div>
                                    </div>
                                    <div class="form-row tm-search-form-row">
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="noadults">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="noadults" class="form-control input-number" value="0" min="0" max="10" id="noadults">
                                                <i class="fa fa-2x fa-user tm-form-element-icon tm-icon-number"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="noadults">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="nokids">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="nokids" class="form-control input-number" value="0" min="0" max="10" id="nokids">
                                                <i class="fa fa-user tm-form-element-icon tm-icon-number tm-form-element-icon-small"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="nokids">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="norooms">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="norooms" class="form-control input-number" value="0" min="0" max="10" id="norooms">
                                                <i class="fa fa-2x fa-door-open tm-form-element-icon tm-icon-number"></i>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="norooms">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <button type="submit" class="btn btn-primary tm-btn-search">Check Availability</button>
                                        </div>
                                      </div>
                                </form>
                            </div>                        
                        </div>      
                    </div>
                </div>                  
            </div>
            
            <div class="tm-section-2">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="tm-section-title">We are here to help you</h2>
                            <p class="tm-color-white tm-section-subtitle">Discover amazing listings</p>
                            <a href="listings.php" class="tm-color-white tm-btn-white-bordered">Explore listings</a>
                        </div>                
                    </div>
                </div>        
            </div>
            
            <div class="tm-section tm-position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="tm-section-down-arrow">
                    <polygon fill="#ee5057" points="0,0  100,0  50,60"></polygon>                   
                </svg> 
                <div class="container tm-pt-5 tm-pb-4">
                    <div class="row text-center">
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                            
                            <i class="fa tm-fa-6x fa-calendar-check tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">Book Your Stay</h3>
                            <p>Discover comfortable and stylish accommodations for your next getaway. Choose from a variety of rooms and book your stay with ease.</p>
                        </article>
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                            
                            <i class="fa tm-fa-6x fa-credit-card tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">Secure Payment Options</h3>
                            <p>Enjoy peace of mind with our secure payment options. Book your reservation online and complete your transaction with confidence.</p>                        
                        </article>
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                           
                            <i class="fa tm-fa-6x fa-comments tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">Customer Satisfaction</h3>
                            <p>Your satisfaction is our priority. Read reviews from our happy guests and book your stay knowing you're in good hands.</p>                        
                        </article>
                    </div>        
                </div>
            </div>
            
            <?php include 'parts/footer.php'; ?>
        </div>
        
        <!-- load JS files -->
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
        <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
        <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
        <script src="js/script.js"></script>

</body>
</html>