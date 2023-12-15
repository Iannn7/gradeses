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


// Get the FACULTY_ID from the URL
if(isset($_GET['FACULTY_ID'])) {
    $faculty_id = $_GET['FACULTY_ID'];

    // Fetch SUBJECT_ID from faculty_subjects table using the provided FACULTY_ID
    $query = "SELECT SUBJECT_ID FROM faculty_subjects WHERE FACULTY_ID = $faculty_id";

    // Execute the query
    $result = mysqli_query($connection, $query);

    if($result) {
        // Fetch subject details from the subjects table using the retrieved SUBJECT_ID
        while($row = mysqli_fetch_assoc($result)) {
            $subject_id = $row['SUBJECT_ID'];
            $subject_query = "SELECT * FROM subjects WHERE ID = $subject_id";
            $subject_result = mysqli_query($connection, $subject_query);

            if($subject_result) {
                $subject_details = mysqli_fetch_assoc($subject_result);

                // Display subject details
                echo "Subject ID: " . $subject_details['ID'] . "<br>";
                echo "Subject Name: " . $subject_details['CODE'] . "<br>";
                // Add more details you want to display
            } else {
                echo "Error fetching subject details: " . mysqli_error($connection);
            }
        }
    } else {
        echo "Error fetching subjects for the faculty: " . mysqli_error($connection);
    }
} else {
    echo "FACULTY_ID not provided in the URL.";
}
?>