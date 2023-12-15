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
    $FIRST_NAME = $_POST["FIRST_NAME"];
    $MIDDLE_NAME = $_POST["MIDDLE_NAME"];
    $LAST_NAME = $_POST["LAST_NAME"];
    $BIRTH_DATE = $_POST["BIRTH_DATE"];
    $GENDER = $_POST["GENDER"];
    $CONTACT_NUM = $_POST["CONTACT_NUM"];
    $INSTITUTE = $_POST["INSTITUTE"];
    $COURSE = $_POST["COURSE"];


    $sql = "UPDATE faculty SET FIRST_NAME = :FIRST_NAME, MIDDLE_NAME = :MIDDLE_NAME, LAST_NAME = :LAST_NAME,
                               BIRTH_DATE = :BIRTH_DATE, GENDER = :GENDER, CONTACT_NUM = :CONTACT_NUM,
                               INSTITUTE = :INSTITUTE, COURSE = :COURSE WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ID' => $ID,
        ':FIRST_NAME' => $FIRST_NAME,
        ':MIDDLE_NAME' => $MIDDLE_NAME,
        ':LAST_NAME' => $LAST_NAME,
        ':BIRTH_DATE' => $BIRTH_DATE,
        ':GENDER' => $GENDER,
        ':CONTACT_NUM' => $CONTACT_NUM,
        ':INSTITUTE' => $INSTITUTE,
        ':COURSE' => $COURSE
    ]);
    header("Location: success-update.php");

      exit; 
}

// Check if an 'id' is provided in the URL
if (isset($_GET["update"])) {
    $ID = $_GET["update"];
    // Retrieve the data for the specified 'id'
    $sql = "SELECT * FROM faculty WHERE ID = :ID";
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
    <div class="container">
        <header>Update Student Details</header>
        <hr style="margin-top: 6px;">

        <form method="POST" style="min-height: 360px;">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Student Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <input type="hidden" name="ID" value="<?php echo $user['ID']; ?>" />
                            <label>First Name</label>
                            <input type="text" name="FIRST_NAME" value="<?php echo $user['FIRST_NAME']; ?>" required />
                        </div>

                        <div class="input-field">
                            <label>Middle Name</label>
                            <input type="text" name="MIDDLE_NAME" value="<?php echo $user['MIDDLE_NAME']; ?>"
                                required />
                        </div>

                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" name="LAST_NAME" value="<?php echo $user['LAST_NAME']; ?>" required />
                        </div>

                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input type="date" name="BIRTH_DATE" value="<?php echo $user['BIRTH_DATE']; ?>" required />
                        </div>

                        <div class="input-field">
                            <label>Gender</label>
                            <select required value="<?php echo $user['GENDER']; ?>" name="GENDER">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Bayot</option>
                                <option>Tomboy</option>
                                <option>Non-Binary</option>
                                <option>Transformer</option>
                                <option>Horse</option>
                                <option>Nigga</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Contact Number</label>
                            <input type="text" name="CONTACT_NUM" value="<?php echo $user['CONTACT_NUM']; ?>"
                                required />
                        </div>

                        <div class="input-field">
                            <label>Institute</label>
                            <input type="text" name="INSTITUTE" value="<?php echo $user['INSTITUTE']; ?>" required />
                        </div>

                        <div class="input-field">
                            <label>Course</label>
                            <input type="text" name="COURSE" value="<?php echo $user['COURSE']; ?>" required />
                        </div>
                        <div class="input-field" style="visibility: hidden;">
                            <label>Course</label>
                            <input type="text" />
                        </div>

                    </div>
                    <div class="buttons" style="position: absolute;left: 36%;">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <a href="faculty.php" class="btnText">Cancel</a>
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