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
</head>

<body>

    <?php  if (isset($_SESSION["ROLE"], $_SESSION["USERNAME"])):

          ?>

    <div class="sidebar close">
        <div class="logo">
            <span class="logo-name" style="margin: 0 auto;">Grading System</span>
        </div>

        <ul class="nav-list">
            <li class="see">
                <a href="index.php">
                    <i class="fab fa-microsoft"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>

            <li>
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
            <span class="text">Welcome <?php echo  $_SESSION["USERNAME"]; ?></span>
        </div>
        <main>
            <ul class="box-info">
                <?php 
            require_once("db.php");
            $sql = "SELECT COUNT(*) as total_faculty FROM faculty_students";
            $studs = "SELECT COUNT(*) as total_student FROM faculty_subjects";
            $cors = "SELECT COUNT(*) as total_courses FROM course";
            $result = $con->query($sql);
            $results = $con->query($studs);
            $resultss = $con->query($cors);

            if ($result->num_rows > 0) {
             // Fetch the result
            $row = $result->fetch_assoc();
            $totalFaculty = $row['total_faculty'];
            
            $rows = $results->fetch_assoc();
            $totalStudent = $rows['total_student'];
            
            $rowss = $resultss->fetch_assoc();
            $totalCourses = $rowss['total_courses'];

            // Close the database connection
        

            // Display the total number of students inside the <h3> tag
            
            echo 
          '<li>
            <i class="fa-solid fa-users"></i>
            <span class="text">
              <h3>' . $totalFaculty . '</h3>
              <p>Total of Students</p>
            </span>
          </li>';
          echo
          '<li>
            <i class="fa-solid fa-atom"></i>
            <span class="text">
              <h3>' . $totalStudent . '</h3>
              <p>Total of Subjects</p>
            </span>
          </li>';
   
          echo
          '<li>
            <i class="fab fa-codepen"></i>
            <span class="text">
              <h3>' . $totalCourses . '</h3>
              <p>Available Courses</p>
            </span>
          </li>
        </ul>';
      } 
        else {
          echo "No students found.";
        }
        ?>

                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Recently Added Students</h3>
                            <!-- <form action="#">
                <div class="form-input">
                 <input type="search" placeholder="Search..." />
                  <button type="submit" class="search-btn">
                  <i class="bx bx-search"></i>
                  </button>
                </div>
              </form> -->
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                
                // Query to fetch the top 5 highest grades
            $queries =  "SELECT s.ID, s.FIRST_NAME, s.LAST_NAME, s.COURSE
                        FROM student AS s
                        LIMIT 5";

            $outcome = $con->query($queries);

            if ($outcome->num_rows > 0) {
                while ($rowing = $outcome->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowing['ID'] . "</td>";
                    echo "<td>" . $rowing['FIRST_NAME'] . "</td>";
                    echo "<td>" . $rowing['LAST_NAME'] . "</td>";
                    echo "<td>" . $rowing['COURSE'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found.</td></tr>";
            }
            $con->close();        
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

        <?php require_once("login.php"); ?>

        <?php endif; ?>

        <script src="app.js"></script>
</body>

</html>