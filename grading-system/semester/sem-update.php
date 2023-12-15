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
    $SCHOOL_YEAR = $_POST["SCHOOL_YEAR"];
    $SEMESTER = $_POST["SEMESTER"];
    $STATUS = $_POST["STATUS"];


    $sql = "UPDATE semester SET SCHOOL_YEAR = :SCHOOL_YEAR, SEMESTER = :SEMESTER, STATUS = :STATUS WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ID' => $ID,
        ':SCHOOL_YEAR' => $SCHOOL_YEAR,
        ':SEMESTER' => $SEMESTER,
        ':STATUS' => $STATUS 
    ]);
    header("Location: ../faculty/success-update.php");
      exit; 
}

// Check if an 'id' is provided in the URL
if (isset($_GET["update"])) {
    $ID = $_GET["update"];
    // Retrieve the data for the specified 'id'
    $sql = "SELECT * FROM semester WHERE ID = :ID";
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
    <div class="container" style="width: 520px;">
        <header>Update Subject Details</header>
        <hr style="margin-top: 6px;">

        <form method="POST" style="min-height: 210px;">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Subject Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <input type="hidden" name="ID" value="<?php echo $user['ID']; ?>" />
                            <label>School Year</label>
                            <input type="text" name="SCHOOL_YEAR" value="<?php echo $user['SCHOOL_YEAR']; ?>"
                                required />
                        </div>

                        <div class="input-field" style="width: 150px;">
                            <label>Semester</label>
                            <select required value="<?php echo $user['SEMESTER']; ?>" name="SEMESTER">
                                <option>1st Semester</option>
                                <option>2nd Semester</option>

                            </select>
                        </div>

                        <div class="input-field">
                            <label>Status</label>
                            <select required value="<?php echo $user['STATUS']; ?>" name="STATUS">
                                <option>active</option>
                                <option>inactive</option>

                            </select>
                        </div>


                    </div>
                    <div class="buttons" style="position: absolute;left: 25%;">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <a href="semester.php" class="btnText">Cancel</a>
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