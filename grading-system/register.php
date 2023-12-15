<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Grading System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />


    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/style.css" type="text/css" media="all" />
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>


    <section class="w3l-mockup-form">
        <div class="container">
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="./img/dorsu-bg.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <p>Grading System. </p>

                        <form action="info.php" method="post">
                            <input type="text" class="name" name="firstName" placeholder="Enter Your First Name">
                            <input type="text" class="name" name="lastName" placeholder="Enter Your Last Name">

                            <input type="email" class="email" name="email" placeholder="Enter Your Email">

                            <input type="password" class="password" name="password" placeholder="Enter Your Password">
                            <input type="password" class="password" name="confirm_password"
                                placeholder="Confirm Your Password">

                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
    $(document).ready(function(c) {
        $('.alert-close').on('click', function(c) {
            $('.main-mockup').fadeOut('slow', function(c) {
                $('.main-mockup').remove();
            });
        });
    });
    </script>

</body>

</html>