<?php
session_start(); // Start the session

// Unset all session variables
session_unset(); 

// Destroy the session
session_destroy(); 

// Create a script that will display an alert and redirect to index.php
echo '<script>
        alert("You have successfully logged out!");
        window.location.href = "index.php";
      </script>';
exit(); // Ensure no further code is executed
?>
