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

        <div class="container register-container">
            <div class="card rounded">
                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm password:</label>
                            <input type="password" class="form-control" id="cpassword" placeholder="Enter your password" required>
                        </div>
                        <div class="form-group">
                            <label for="pnumber">Phone number:</label>
                            <input type="text" class="form-control" id="pnumber" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="fname">First name:</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last name:</label>
                            <input type="text" class="form-control" id="lname" placeholder="Enter your last name" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Create an account</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="login.php" class="login-link">Login here</a></p>
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

</body>

</html>