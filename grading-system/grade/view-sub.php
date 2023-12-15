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

    if (isset($_GET['FACULTY_ID'])) {
        $faculty_id = $_GET['FACULTY_ID'];

        // Fetch FIRST_NAME and LAST_NAME from the faculty table using the provided FACULTY_ID
        $query = "SELECT FIRST_NAME, LAST_NAME FROM faculty WHERE ID = $faculty_id";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $faculty_details = mysqli_fetch_assoc($result);
            echo $faculty_details['FIRST_NAME'] . " " . $faculty_details['LAST_NAME'] . " List of Subjects";

        } else {
            echo "Faculty details not found.";
        }
    } else {
        echo "FACULTY_ID not provided in the URL.";
    }
    ?>
            </span>

        </div>



        <table class="content-table">

            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
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

        // Check if sub_id is provided in the URL for deletion
        // Check if sub_id is provided in the URL for deletion
     // Check if sub_id is provided in the URL for deletion
if (isset($_GET['sub_id'])) {
    $sub_id = $_GET['sub_id'];

    // Delete the entire row in faculty_subjects table where SUBJECT_ID matches the provided sub_id
    $delete_query = "DELETE FROM faculty_subjects WHERE SUBJECT_ID = $sub_id";
    $delete_result = mysqli_query($connection, $delete_query);

    if ($delete_result) {
        // On successful deletion, redirect or perform other actions
        echo '<script>alert("Deleted Successfully")</script>';
        exit();
    } else {
        echo "Error deleting subject from faculty: " . mysqli_error($connection);
    }
}


       
        

                if (isset($_GET['FACULTY_ID'])) {
                $faculty_id = $_GET['FACULTY_ID'];
                $students_found = false;

                // Fetch SUBJECT_ID from faculty_subjects table using the provided FACULTY_ID
                $query = "SELECT SUBJECT_ID FROM faculty_subjects WHERE FACULTY_ID = $faculty_id";
                $result = mysqli_query($connection, $query);

                if ($result) {
                // Fetch subject details from the subjects table using the retrieved SUBJECT_ID
                while ($row = mysqli_fetch_assoc($result)) {
                $subject_id = $row['SUBJECT_ID'];
                $subject_query = "SELECT * FROM subjects WHERE ID = $subject_id";
                $subject_result = mysqli_query($connection, $subject_query);
                $students_found = true;

                if ($subject_result && mysqli_num_rows($subject_result) > 0) {
                $subject_details = mysqli_fetch_assoc($subject_result);
              
                $facSub_query = "SELECT ID FROM faculty_subjects WHERE SUBJECT_ID = $subject_id AND FACULTY_ID = $faculty_id";
                $facSub_result = mysqli_query($connection, $facSub_query);
            
                if ($facSub_result && mysqli_num_rows($facSub_result) > 0) {
                    $facSub_details = mysqli_fetch_assoc($facSub_result);
                    $facSub_id = $facSub_details['ID'];
                } else {
                    echo "Error fetching faculty subject details: " . mysqli_error($connection);
                }
                ?>
                <tr>
                    <td><?php echo $subject_details['CODE']; ?></td>
                    <td><?php echo $subject_details['DESCRIPTION']; ?></td>
                    <td><?php echo $subject_details['UNIT']; ?></td>
                    <td><?php echo $subject_details['TYPE']; ?></td>
                    <td>
                        <a href="view-sub.php?sub_id=<?= $subject_details['ID']; ?>">Remove</a>
                        <a href="fac-stud.php?sub_id=<?= $subject_details['ID']; ?>">Add Students</a>
                        <a href="view-stud.php?facSub_id=<?= $facSub_details['ID']; ?>">View Students</a>
                    </td>
                </tr>
                <?php
                    } else {
                        echo "Error fetching subject details: " . mysqli_error($connection);
                    }
                }
            } else {
                echo "Error fetching subjects for the faculty: " . mysqli_error($connection);
            }
            if (!$students_found) {
                ?>
                <tr>
                    <td colspan="5">No loaded subjects</td>
                </tr>
                <?php
            }
        } else {
            echo "FACULTY_ID not provided in the URL.";
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