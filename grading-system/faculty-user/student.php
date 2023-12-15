<?php

session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grading System</title>

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!--css file-->
    <link rel="stylesheet" href="./CSS/main.css" />
    <link rel="stylesheet" href="./CSS/tables.css" />
</head>

<body>

    <?php  if (isset($_SESSION["ROLE"], $_SESSION["USERNAME"])):?>

    <div class="sidebar close">
        <div class="logo">
            <span class="logo-name" style="margin: 0 auto;">Grading System</span>
        </div>

        <ul class="nav-list">
            <li>
                <a href="index.php">
                    <i class="fab fa-microsoft"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>

            <li class="see">
                <div class="icon-link">
                    <a href="student.php">
                        <i class="fa-solid fa-user"></i>
                        <span class="link-name">Students</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="icon-link">
                    <a href="./grade/grade.php">
                        <i class="fa-solid fa-award"></i>
                        <span class="link-name">Grade</span>
                    </a>
                </div>
            </li>

            <li>
                <div class="icon-link">
                    <a href="./faculty/faculty.php">
                        <i class="fas fa-file"></i>
                        <span class="link-name">Report</span>
                    </a>

                </div>
            </li>




            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <a href="profile.php?update=<?= $_SESSION["ROLE"]; ?>"><img src="./img/user.jpg" alt="" /></a>
                    </div>


                    <div class="name-job">
                        <div class="name"><a href="profile.php?update=<?= $_SESSION["ROLE"]; ?>"
                                style="color: white;"><?php echo  $_SESSION["USERNAME"]; ?></a> </div>
                        <div class="job">Faculty</div>
                    </div>

                    <a href="../logout.php"><i class="fas fa-right-to-bracket"></i></a>
                </div>
            </li>
        </ul>
    </div>

    <div class="home-section">
        <div class="home-content">
            <i class="fas fa-bars"></i>
            <span class="text">List of Students</span>

        </div>

        <?php
    require_once("../db.php");

    // Assuming $_SESSION["USERNAME"] holds the username
    $username = $_SESSION["USERNAME"];

    // Fetching faculty ID from the faculty table based on the username
    $facultyQuery = "SELECT ID FROM faculty WHERE USERNAME = '$username'";
    $facultyResult = mysqli_query($con, $facultyQuery);
    
    if ($facultyResult && mysqli_num_rows($facultyResult) > 0) {
        $facultyData = mysqli_fetch_assoc($facultyResult);
        $facultyID = $facultyData['ID'];

        // Check if a search query has been submitted
        if(isset($_POST['search'])) {
            $searchKeyword = $_POST['search'];

            // Fetching students associated with the faculty based on search keyword
            $studentQuery = "SELECT s.* FROM student s
                             INNER JOIN faculty_students fs ON s.ID = fs.student_id
                             WHERE fs.faculty_id = '$facultyID'
                             AND (s.ID LIKE '%$searchKeyword%' OR s.FIRST_NAME LIKE '%$searchKeyword%' OR s.LAST_NAME LIKE '%$searchKeyword%')";
            $studentResult = mysqli_query($con, $studentQuery);
        } else {
            // If no search query, fetch all students associated with the faculty
            $studentQuery = "SELECT s.* FROM student s
                             INNER JOIN faculty_students fs ON s.ID = fs.student_id
                             WHERE fs.faculty_id = '$facultyID'";
            $studentResult = mysqli_query($con, $studentQuery);
        }
?>
        <!-- Form for searching students -->
        <form method="POST" class="search">
            <input type="text" name="search" placeholder="Search Students">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <table class="content-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Institute</th>
                </tr>
            </thead>
            <tbody>
                <?php 
        while ($row = mysqli_fetch_assoc($studentResult)) {
            $studentID = $row['ID'];
            $firstName = $row['FIRST_NAME'];
            $lastName = $row['LAST_NAME'];
            $course = $row['COURSE'];
            $institute = $row['INSTITUTE'];
?>
                <tr>
                    <td><?php echo $studentID; ?></td>
                    <td><?php echo $firstName; ?></td>
                    <td><?php echo $lastName; ?></td>
                    <td><?php echo $course; ?></td>
                    <td><?php echo $institute; ?></td>
                </tr>
                <?php 
        }
?>
            </tbody>
        </table>
        <?php 
    } else {
        echo "No faculty found for this username.";
    }
?>



    </div>
    </div>
    </main>
    <!-- MAIN -->
    </section>

    <?php else: ?>

    <?php require_once("login.php"); ?>

    <?php endif; ?>

    <script src="app.js"></script>
</body>

</html>