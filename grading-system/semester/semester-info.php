<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Subject Record</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="infos.css">
</head>

<body>

    <div class="container">



        <?php
                $mysqli = mysqli_connect("localhost", "root", "", "grading_system");

                $sql = "INSERT INTO semester (SCHOOL_YEAR, SEMESTER, STATUS)
                        VALUES (?,?,?)";
                $stmt = $mysqli->stmt_init(); 

                if (! $stmt->prepare($sql)){
                    die ("SQL error" . $mysqli->error);
                }

                $stmt->bind_param("sss",
                                $_POST["SCHOOL_YEAR"],
                                $_POST["SEMESTER"],
                                $_POST["STATUS"]);

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