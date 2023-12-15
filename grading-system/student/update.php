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
    $PUROK = $_POST["PUROK"];
    $BARANGAY = $_POST["BARANGAY"];
    $MUNICIPALITY = $_POST["MUNICIPALITY"];
    $PROVINCE = $_POST["PROVINCE"];
    $ZIP_CODE = $_POST["ZIP_CODE"];
    $CONTACT_NUM = $_POST["CONTACT_NUM"];
    $INSTITUTE = $_POST["INSTITUTE"];
    $COURSE = $_POST["COURSE"];
    $GUARDIAN = $_POST["GUARDIAN"];
    $GUARD_CONTACT = $_POST["GUARD_CONTACT"];
    $GUARD_ADDRESS = $_POST["GUARD_ADDRESS"];


    $sql = "UPDATE student SET FIRST_NAME = :FIRST_NAME, MIDDLE_NAME = :MIDDLE_NAME, LAST_NAME = :LAST_NAME,
                               BIRTH_DATE = :BIRTH_DATE, GENDER = :GENDER, PUROK = :PUROK, BARANGAY = :BARANGAY, 
                               MUNICIPALITY = :MUNICIPALITY, PROVINCE = :PROVINCE, ZIP_CODE = :ZIP_CODE, CONTACT_NUM = :CONTACT_NUM,
                               INSTITUTE = :INSTITUTE, COURSE = :COURSE, GUARDIAN = :GUARDIAN, GUARD_CONTACT = :GUARD_CONTACT, GUARD_ADDRESS = :GUARD_ADDRESS WHERE ID = :ID
                               ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ID' => $ID,
        ':FIRST_NAME' => $FIRST_NAME,
        ':MIDDLE_NAME' => $MIDDLE_NAME,
        ':LAST_NAME' => $LAST_NAME,
        ':BIRTH_DATE' => $BIRTH_DATE,
        ':GENDER' => $GENDER,
        ':PUROK' => $PUROK,
        ':BARANGAY' => $BARANGAY,
        ':MUNICIPALITY' => $MUNICIPALITY,
        ':PROVINCE' => $PROVINCE,
        ':ZIP_CODE' => $ZIP_CODE,
        ':CONTACT_NUM' => $CONTACT_NUM,
        ':INSTITUTE' => $INSTITUTE,
        ':COURSE' => $COURSE,
        ':GUARDIAN' => $GUARDIAN,
        ':GUARD_CONTACT' => $GUARD_CONTACT,
        ':GUARD_ADDRESS' => $GUARD_ADDRESS
    ]);
    header("Location: ../faculty/success-update.php");
    exit; 
}

// Check if an 'id' is provided in the URL
if (isset($_GET["update"])) {
    $ID = $_GET["update"];
    // Retrieve the data for the specified 'id'
    $sql = "SELECT * FROM student WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':ID' => $ID]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "User with ID $ID not found.";
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

        <form method="POST">
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
                </div>

                <div class=" details ID">
                    <span class="title">Emergency Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Purok</label>
                            <input type="text" name="PUROK" value="<?php echo $user['PUROK']; ?>" required>
                        </div>

                        <div class="input-field">
                            <label>Barangay</label>
                            <input type="text" name="BARANGAY" value="<?php echo $user['BARANGAY']; ?>" required>
                        </div>

                        <div class="input-field">
                            <label>Municipality</label>
                            <input type="text" name="MUNICIPALITY" value="<?php echo $user['MUNICIPALITY']; ?>"
                                required>
                        </div>

                        <div class="input-field">
                            <label>Province</label>
                            <input type="text" name="PROVINCE" value="<?php echo $user['PROVINCE']; ?>" required>
                        </div>

                        <div class="input-field">
                            <label>Zip Code</label>
                            <input type="text" name="ZIP_CODE" value="<?php echo $user['ZIP_CODE']; ?>" required>
                        </div>
                        <div class="input-field" style="visibility: hidden;">
                            <label>Course</label>
                            <input type="text" />
                        </div>

                        <div class=" input-field">
                            <label>Guardian Name</label>
                            <input type="text" name="GUARDIAN" value="<?php echo $user['GUARDIAN']; ?>" required>
                        </div>

                        <div class="input-field">
                            <label>Guardian Contact Number</label>
                            <input type="text" name="GUARD_CONTACT" value="<?php echo $user['GUARD_CONTACT']; ?>"
                                required>
                        </div>

                        <div class="input-field">
                            <label>Guardian Address</label>
                            <input type="text" name="GUARD_ADDRESS" value="<?php echo $user['GUARD_ADDRESS']; ?>"
                                required>
                        </div>
                    </div>
                </div>
                <div class="buttons" style="position: absolute;left: 36%;">
                    <div class="backBtn">
                        <i class="uil uil-navigator"></i>
                        <a href="students.php" class="btnText">Cancel</a>
                    </div>

                    <button class="sumbit">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator" style="font-size: 18px;"></i>
                    </button>
                </div>
            </div>


        </form>
    </div>
</body>

</html>