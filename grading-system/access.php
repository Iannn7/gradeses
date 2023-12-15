<?php
session_start();

// Check if the user is logged in and has a role set in the session
if(isset($_SESSION["ROLE"])) {
    $userRole = $_SESSION["ROLE"];

    // Check if the user role is 'faculty'
    if($userRole === "faculty") {
        // The user is a faculty member, allow access to the grade folder
        $gradeFolder = __DIR__ . "/grade/"; // Set the path to your grade folder

        // Display the content of the grade folder
        if(is_dir($gradeFolder)) {
            $files = scandir($gradeFolder);
            foreach($files as $file) {
                if($file != '.' && $file != '..') {
                    echo $file . "<br>";
                }
            }
        } else {
            echo "Grade folder not found.";
        }
    } else {
        // For other roles, deny access to the grade folder
        echo "Access denied. You do not have permission to view this content.";
    }
} else {
    // Redirect to login page or handle unauthorized access
    echo "Please log in to access this content.";
}

?>