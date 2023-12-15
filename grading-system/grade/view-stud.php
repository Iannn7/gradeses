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
    <link rel="stylesheet" href="../CSS/main.css" />
    <link rel="stylesheet" href="../CSS/tables.css">
</head>

<body>

    <?php  if (isset($_SESSION["ROLE"])):

          ?>

    <div class="sidebar close">
        <div class="logo">
            <span class="logo-name" style="margin: 0 auto;">Grading System</span>
        </div>

        <ul class="nav-list">
            <li>
                <a href="../index.php">
                    <i class="fab fa-microsoft"></i>
                    <span class="link-name">Dashboard</span>
                </a>

                <ul class="sub-menu blank">
                    <li><a href="../index.php" class="link-name">Dashboard</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="../student/students.php">
                        <i class="fa-solid fa-user"></i>
                        <span class="link-name">Student</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="#" class="link-name">Student Records</a></li>
                    <li><a href="../student/student-list.php">List of Students</a></li>
                    <li><a href="../student/home-address.php">Home Address</a></li>
                    <li><a href="../student/emergency.php">Emergency Contact</a></li>
                    <li><a href="#">Add New Record</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="../faculty/faculty.php">
                        <i class="fa-solid fa-users"></i>
                        <span class="link-name">Faculty</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="../faculty/faculty.php" class="link-name">Faculty Records</a></li>
                    <li><a href="../faculty/faculty-list.php">List of Faculty</a></li>
                    <li><a href="../faculty/new-record.php">Add New Record</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="../subject/subject.php">
                        <i class="fa-solid fa-atom"></i>
                        <span class="link-name">Subject</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="../subject/subject.php" class="link-name">Subject</a></li>
                    <li><a href="../subject/subject-list.php">List of Subjects</a></li>
                    <li><a href="../subject/new-record.php">Add New Subject</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="../course/course.php">
                        <i class="fab fa-codepen"></i>
                        <span class="link-name">Course</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="../course/course.php" class="link-name">Courses</a></li>
                    <li><a href="../course/course-list.php">Available Courses</a></li>
                    <li><a href="../course/new-record.php">Add New Course</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="../institute/institute.php">
                        <i class="fa-solid fa-folder-open"></i>
                        <span class="link-name">Institute</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="../institute/institute.php" class="link-name">Institute</a></li>
                    <li><a href="../institute/institute-list.php">List of Institute</a></li>
                    <li><a href="../institute/new-record.php">Add New Institute</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="../semester/semester.php">
                        <i class="fa-regular fa-calendar"></i>
                        <span class="link-name">Semester</span>
                    </a>
                </div>
            </li>

            <li class="see">
                <div class="icon-link">
                    <a href="grade.php">
                        <i class="fa-solid fa-award"></i>
                        <span class="link-name">Grade</span>
                    </a>
                </div>
            </li>

            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <a href="../profile.php?update=<?= $_SESSION["ROLE"]; ?>"><img src="../img/user.jpg"
                                alt="" /></a>
                    </div>
                    <div class="name-job">
                        <div class="name"><a href="profile.php" style="color: white;">Admin</a> </div>
                        <div class="job">Admin</div>
                    </div>
                    <a href="../login.php"><i class="fas fa-right-to-bracket"></i></a>
                </div>
            </li>
        </ul>
    </div>

    <div class="home-section">
        <div class="home-content">
            <i class="fas fa-bars"></i>
            <span class="text">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "grading_system";
     
                // Create connection
                $connection = mysqli_connect($servername, $username, $password, $database);
                
                // Check connection
                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if (isset($_GET['facSub_id'])) {
                    $facSub_ID = $_GET['facSub_id'];

                    // Fetch FIRST_NAME and LAST_NAME from the faculty table using the provided facSub_ID
                    $query = "SELECT f.FIRST_NAME, f.LAST_NAME 
                    FROM faculty f 
                    INNER JOIN faculty_subjects fs ON f.ID = fs.faculty_id 
                    WHERE fs.ID = $facSub_ID";
          
                    $result = mysqli_query($connection, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $faculty_details = mysqli_fetch_assoc($result);
                        echo $faculty_details['FIRST_NAME'] . " " . $faculty_details['LAST_NAME'] . " List of Students";
                            
                    } else {
                        echo "Faculty details not found.";
                    }
                } else {
                    echo "facSub_ID not provided in the URL.";
                }
                ?>
            </span>

        </div>


        <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "grading_system";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure the ID is numeric and set in the URL
if (isset($_GET['facSub_id']) && is_numeric($_GET['facSub_id'])) {
    $FACULTY_SUBJECTS_ID = $_GET['facSub_id'];

    // Prepare the query using parameterized statements to prevent SQL injection
    $query = "SELECT s.* FROM student s
              INNER JOIN faculty_students fs ON s.ID = fs.STUDENT_ID
              INNER JOIN faculty_subjects fsub ON fs.FAC_SUB_ID = fsub.ID
              WHERE fs.FAC_SUB_ID = ?";
    $stmt = mysqli_prepare($connection, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, 'i', $FACULTY_SUBJECTS_ID);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get results
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) > 0) {
        ?>
        <table class="content-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
            while ($student_details = mysqli_fetch_assoc($result)) {
                ?>
                <!-- Display student details -->
                <tr>
                    <td><?php echo $student_details['FIRST_NAME']; ?></td>
                    <td><?php echo $student_details['MIDDLE_NAME']; ?></td>
                    <td><?php echo $student_details['LAST_NAME']; ?></td>
                    <td><?php echo $student_details['COURSE']; ?></td>
                    <td>
                        <a href="view-stud.php?stud_id=<?= $student_details['ID']; ?>">Remove</a>
                    </td>
                </tr>
                <?php
            }
            ?>

                <?php
    } 
    
    else {
                 ?>
                <!-- Display message if no students found -->
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Course</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Display message if no students found -->
                        <tr>
                            <td colspan="5" style="color: red; font-weight: 600;">No List of Students</td>
                        </tr>
                    </tbody>
                </table>
                <?php
    }
     } else {
    echo "Invalid or missing ID in the URL.";
}
?>

            </tbody>
        </table>
    </div>
    </div>
    </main>
    <!-- MAIN -->
    </section>
    <!-- CONTENT -->




    <?php endif; ?>

    <script src="../app.js"></script>
</body>

</html>