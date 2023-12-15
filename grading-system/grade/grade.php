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

    <?php  if (isset($_SESSION["ROLE"])):  ?>

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
            <span class="text">Grades</span>
        </div>

        <?php

      require_once("../db.php");
        $Query = "SELECT * FROM faculty";
        $studentResult = mysqli_query($con, $Query);

    

      ?>

        <table class="content-table">
            <div class="add-new">
                <a href="fac-sub.php">Add Subject</a>
            </div>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Institute</th>
                    <th>Course</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($row=mysqli_fetch_assoc( $studentResult))
                {
                    $UserID = $row['ID'];
                    $FIRST_NAME = $row['FIRST_NAME'];
                    $LAST_NAME = $row['LAST_NAME'];
                    $INSTITUTE = $row['INSTITUTE'];
                    $COURSE = $row['COURSE'];
              ?>

                <tr>
                    <td><?php echo $UserID ?></td>
                    <td><?php echo $FIRST_NAME ?></td>
                    <td><?php echo $LAST_NAME ?></td>
                    <td><?php echo $INSTITUTE ?></td>
                    <td><?php echo $COURSE ?></td>
                    <td>
                        <a href="view-sub.php?FACULTY_ID=<?= $row['ID']; ?>">View Subjects</a>

                    </td>

                </tr>
                <?php 
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

    <?php else: ?>

    <?php require_once("../login.php"); ?>

    <?php endif; ?>

    <script src="../app.js"></script>
</body>

</html>