<?php
$isInvalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    if ($mysqli instanceof mysqli) {
        $sql = sprintf("SELECT USERNAME, PASSWORD, ROLE FROM admin
                WHERE USERNAME = '%s'
                UNION
                SELECT USERNAME, PASSWORD, ROLE FROM student
                WHERE USERNAME = '%s'
                UNION
                SELECT USERNAME, PASSWORD, ROLE FROM faculty
                WHERE USERNAME = '%s'",
                $mysqli->real_escape_string($_POST["USERNAME"]),
                $mysqli->real_escape_string($_POST["USERNAME"]),
                $mysqli->real_escape_string($_POST["USERNAME"]));

        $result = $mysqli->query($sql);

        if ($result) {
            $user = $result->fetch_assoc();

            if ($user['ROLE'] == "admin") {
                if ($_POST["PASSWORD"] === $user["PASSWORD"]) {
                    session_start();
                    session_regenerate_id();
 
                    $_SESSION["ROLE"] = $user["ROLE"];
                    $_SESSION["USERNAME"] = $user["USERNAME"];

                    header("Location: index.php");
                    exit;
                }
            } elseif ($user['ROLE'] == "faculty") {
                if ($_POST["PASSWORD"] === $user["PASSWORD"]) {
                    session_start();
                    session_regenerate_id();

                    $_SESSION["ROLE"] = $user["ROLE"];
                    $_SESSION["USERNAME"] = $user["USERNAME"];
                    $_SESSION["FACULTY_ID"] = $user["ID"];

                    // Redirect to grade folder for faculty
                    header("Location: ./faculty-user/index.php");
                    exit;
                }
            } else {
                // Other roles or invalid credentials
                $isInvalid = true;
            }
        } else {
            echo "Error in query: " . $mysqli->error;
        }
    } else {
        echo "Database connection error";
    }

    $isInvalid = true; // Set this flag if login is invalid
}

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>AC Builders EMS</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="./CSS/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        </div>
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">

                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="./img/dorsu-bg.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Grading System </p>
                        <form action="" method="post">
                            <?php
                        if ($isInvalid):  ?>
                            <p class="login-error" style="color: red;">Invalid Login</p>
                            <?php endif; ?>
                            <input type="text" class="email" name="USERNAME" placeholder="Enter Username" required>
                            <input type="password" class="password" name="PASSWORD" placeholder="Enter Your Password"
                                style="margin-bottom: 2px;" required>

                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->


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