<?php
$mysqli = mysqli_connect("localhost", "root", "", "grading_system");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if form fields are set and not empty
    if (isset($_POST["FAC_SUB_ID"]) && isset($_POST["STUDENT_ID"]) &&
        !empty($_POST["FAC_SUB_ID"]) && !empty($_POST["STUDENT_ID"])) {

        // Validate input (e.g., ensure they are integers)
        $facSubID = intval($_POST["FAC_SUB_ID"]);
        $studentID = intval($_POST["STUDENT_ID"]);

        // Prepare and execute the SQL query
        $sql = "INSERT INTO faculty_students (FAC_SUB_ID, STUDENT_ID) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("ii", $facSubID, $studentID);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                window.onload = function () { alert("Student Added Successfully"); } 
                </script>';
        } else {
            if ($mysqli->errno === 1062) {
                die("Student for this faculty already exists.");
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
    } else {
        // Handle case when POST data is missing or empty
        echo "Please fill in all the fields.";
    }
}

// Fetch FAC_SUB_ID from faculty_subjects using sub_id from URL
if (isset($_GET['sub_id'])) {
    $subID = intval($_GET['sub_id']);
    $fetchQuery = "SELECT ID FROM faculty_subjects WHERE SUBJECT_ID = ?";
    $stmt = $mysqli->prepare($fetchQuery);
    $stmt->bind_param("i", $subID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $facSubID = $row['ID'];
    }
    $stmt->close();
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="../CSS/update.css">

    <title>Add Students</title>
</head>

<body>
    <div class="container" style="width: 380px;">
        <header>Add Students to Faculty</header>
        <form method="POST" style="min-height: 180px;">
            <div class="form first">
                <div class="details personal">
                    <div class="fields">
                        <div class="input-field" style="width: 150px;">
                            <label>Faculty_Subject ID</label>
                            <?php
                            if (isset($facSubID)) {
                                echo '<input type="number" name="FAC_SUB_ID" value="' . $facSubID . '" required readonly />';
                            } else {
                                echo '<input type="number" name="FAC_SUB_ID" required />';
                            }
                            ?>
                        </div>
                        <div class="input-field" style="width: 150px; margin-left: 20px;">
                            <label>Student ID</label>
                            <input type="number" name="STUDENT_ID" required />
                        </div>
                    </div>
                    <div class="buttons" style="position: absolute;left: 16%;">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <a href="grade.php" class="btnText">Cancel</a>
                        </div>

                        <button class="sumbit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator" style="font-size: 18px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>