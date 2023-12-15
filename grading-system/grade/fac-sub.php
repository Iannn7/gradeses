<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="../CSS/update.css">

    <title>Add Subject</title>
</head>

<body>
    <div class="container" style="width: 380px;">
        <header>Add Faculty Subject</header>

        <form method="POST" style="min-height: 180px;">
            <div class="form first">
                <div class="details personal">

                    <div class="fields">
                        <div class="input-field" style="width: 150px;">
                            <label>Faculty ID</label>
                            <input type="number" name="FACULTY_ID" required />
                        </div>
                        <div class="input-field" style="width: 150px; margin-left: 20px;">
                            <label>Subject ID</label>
                            <input type="number" name="SUBJECT_ID" required />
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
    </div>

    </div>


    </form>
    </div>
</body>

</html>


<?php
$mysqli = mysqli_connect("localhost", "root", "", "grading_system");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if form fields are set and not empty
    if (isset($_POST["FACULTY_ID"]) && isset($_POST["SUBJECT_ID"]) &&
        !empty($_POST["FACULTY_ID"]) && !empty($_POST["SUBJECT_ID"])) {

        // Validate input (e.g., ensure they are integers)
        $facultyID = intval($_POST["FACULTY_ID"]);
        $subjectID = intval($_POST["SUBJECT_ID"]);

        // Prepare and execute the SQL query
        $sql = "INSERT INTO faculty_subjects (FACULTY_ID, SUBJECT_ID) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("ii", $facultyID, $subjectID);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                window.onload = function () { alert("Subject Added Successfully"); } 
                </script>';
        } else {
            if ($mysqli->errno === 1062) {
                die("Subject for this faculty already exists.");
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
    } else {
        // Handle case when POST data is missing or empty
        echo "Please fill in all the fields.";
    }
}
?>