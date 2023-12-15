<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="infos.css">
</head>

<body>

    <div class="container">



        <?php

            // // Retrieve form data
            // $firstName = $_POST["firstName"];
            // $lastName = $_POST["lastName"]; 
            // $password = $_POST["password"];
            // $email = $_POST["email"];
                      
          if (empty($_POST["USERNAME"])){
              echo "Username is required.";
            }
            // if (! filter_var($_POST(["email" and "confirm_email"], FILTER_VALIDATE_EMAIL))){
            //   echo "Valid is required.";
            // }
            if (strlen($_POST["password"]) < 8) {
              echo "Password must be at least 8 characters.";
            }

            if (! preg_match("/[a-z]/i", $_POST["password"])){
              echo "Password must contain at least 1 letter.";
            }
            if (! preg_match("/[0-9]/i", $_POST["password"])){
              echo "Password must contain a number.";
            }
            if ($_POST["password"] !== $_POST["confirm_password"]){
              echo "Password must match.";
            }


          $mysqli = require __DIR__ . "/database.php";
          $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

          $sql = "INSERT INTO user (first_name, last_name, email, password_hash)
                  VALUES (?, ?, ?, ?)";
          $stmt = $mysqli->stmt_init(); 

          if (! $stmt->prepare($sql)){
              die ("SQL error" . $mysqli->error);
          }

          $stmt->bind_param("ssss",
                            $_POST["firstName"],
                            $_POST["lastName"],
                            $_POST["email"],
                            $password_hash);

          if ($stmt->execute()){
              header("Location: success.php");
              exit;
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