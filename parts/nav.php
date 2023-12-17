<?php
    require_once 'lib/Common.php';
    $common = new \lib\Common();
    $common->startSession();
    $active = "active";
    if (strpos($_SERVER['PHP_SELF'], 'index.php')) {
        $active = "";
    }
?>

<div class="tm-top-bar <?= $active ?>" id="tm-top-bar">
    <!-- Top Navbar -->
    <div class="container">
        <div class="row">
            
            <nav class="navbar navbar-expand-lg narbar-light">
                <a class="navbar-brand mr-auto" href="index.php">
                    <img src="img/logo.png" alt="Site logo">
                    Booking
                </a>
                <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="listings.php">Listings</a>
                        </li>
                        <?php if ($common->isUserLoggedIn()) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="reservations.php">My reservations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="auth/logout.php">Logout</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>                            
            </nav>            
        </div>
    </div>
</div>