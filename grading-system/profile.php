<?php
    $dsn = "mysql:host=localhost;dbname=grading_system";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission
        $ROLE = $_POST["ROLE"];
        $FIRST_NAME = $_POST["FIRST_NAME"];
        $LAST_NAME = $_POST["LAST_NAME"];
        $USERNAME = $_POST["USERNAME"];

        // Update the data in the database
        $sql = "UPDATE admin SET FIRST_NAME = :FIRST_NAME, LAST_NAME = :LAST_NAME, USERNAME = :USERNAME WHERE ROLE = :ROLE";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ROLE' => $ROLE,
            ':FIRST_NAME' => $FIRST_NAME,
            ':LAST_NAME' => $LAST_NAME,
            ':USERNAME' => $USERNAME
        ]);
        header("Location: index.php");
        exit; 
    }

    // Check if an 'id' is provided in the URL
    if (isset($_GET["update"])) {
        $ROLE = $_GET["update"];
        // Retrieve the data for the specified 'id'
        $sql = "SELECT * FROM admin WHERE ROLE = :ROLE";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ROLE' => $ROLE]);
        $user = $stmt->fetch();

        if (!$user) {
            echo "User with ROLE $ROLE not found.";
            exit;
        }
    } else {
        echo "Please provide an 'id' in the URL.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Profile</title>
    <link rel="stylesheet" href="./CSS/profile.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">Account settings</h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light bg" style="background-image: url(banner.png);
                    background-size: cover;
                    background-repeat: no-repeat; background-position: center;">
                <div class="col-md-3 pt-0"></div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general"
                            style="position: relative; left: -130px">
                            <div class="card-body media align-items-center">
                                <img src="user.jpg" alt class="d-block ui-w-80" />
                                <div class="media-body ml-4">
                                    &nbsp;
                                </div>
                            </div>

                            <form method="POST" class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $user['ROLE']; ?>">
                                    <label for="FIRST_NAME" class="form-label">First Name</label>
                                    <input type="text" class="form-control mb-1" name="FIRST_NAME"
                                        value="<?php echo $user['FIRST_NAME']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="LAST_NAME" class="form-label">Last Name</label>
                                    <input type="text" class="form-control mb-1" name="LAST_NAME"
                                        value="<?php echo $user['LAST_NAME']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input value="<?php echo $user['USERNAME']; ?>" type="text" class="form-control"
                                        name="USERNAME" />
                                </div>
                                <div class="text-right mt-3">
                                    <input type="submit" value="Save changes" class="btn btn-primary">
                                    &nbsp;
                                    <a href="index.php">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>