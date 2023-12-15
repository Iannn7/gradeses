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

    $ID = $_POST["ID"];
    $INSTIUTE_NAME = $_POST["INSTIUTE_NAME"];


    $sql = "UPDATE institute SET INSTIUTE_NAME = :INSTIUTE_NAME WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ID' => $ID,
        ':INSTIUTE_NAME' => $INSTIUTE_NAME
    ]);
    header("Location: ../faculty/success-update.php");
      exit; 
}

// Check if an 'id' is provided in the URL
if (isset($_GET["update"])) {
    $ID = $_GET["update"];
    // Retrieve the data for the specified 'id'
    $sql = "SELECT * FROM institute WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':ID' => $ID]);
    $user = $stmt->fetch();

    if (!$user) {
        echo '<script type="text/javascript">
        window.onload = function () { alert("User with ID' .$ID. 'not found"); } 
        </script>'; 
        exit;
    }
} else {
    echo '<script type="text/javascript">
        window.onload = function () { alert("Please provide ID in the URL"); } 
        </script>'; 
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="../CSS/update.css">

    <title>Update Information</title>
</head>

<body>
    <div class="container" style="width: 500px;">
        <header>Update Institute Details</header>

        <form method="POST" style="min-height: 150px; ">
            <div class="form first">
                <div class="details personal">

                    <div class="fields" style="width: 1350px; ">
                        <div class="input-field">
                            <label>Institute Name</label>
                            <input type="text" name="INSTIUTE_NAME" value="<?php echo $user['INSTIUTE_NAME']; ?>"
                                required />
                        </div>

                    </div>
                    <div class="buttons" style="position: absolute;left: 8%;">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <a href="institute.php" class="btnText">Cancel</a>
                        </div>

                        <button class="sumbit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator" style="font-size: 18px;"></i>
                        </button>
                    </div>
                </div>
            </div>
    </div>

    </div>


    </form>
    </div>
</body>

</html>