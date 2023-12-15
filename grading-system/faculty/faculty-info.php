<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Faculty Record</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="infos.css">
</head>

<body>

    <div class="container">



        <?php
                $mysqli = mysqli_connect("localhost", "root", "", "grading_system");

                $sql = "INSERT INTO faculty (USERNAME, PASSWORD, FIRST_NAME, MIDDLE_NAME, LAST_NAME, BIRTH_DATE, GENDER, INSTITUTE, COURSE, CONTACT_NUM)
                        VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $mysqli->stmt_init(); 

                if (! $stmt->prepare($sql)){
                    die ("SQL error" . $mysqli->error);
                }

                $stmt->bind_param("sssssssssi",
                                $_POST["USERNAME"],
                                $_POST["PASSWORD"],
                                $_POST["FIRST_NAME"],
                                $_POST["MIDDLE_NAME"],
                                $_POST["LAST_NAME"],
                                $_POST["BIRTH_DATE"],
                                $_POST["GENDER"],
                                $_POST["INSTITUTE"],
                                $_POST["COURSE"],
                                $_POST["CONTACT_NUM"]);

                if ($stmt->execute()){
                    echo '<script type="text/javascript">
                    window.onload = function () { alert("Created Successfully"); } 
                    </script>'; 
                  
                }
                else {
                    if($mysqli->errno === 1062){
                        die("email already exist");
                    }
                    else{
                        die($mysqli->error . " " . $mysqli->errno);
                    }
                }   
        ?>
    </div>
    </div>

</body>

</html>