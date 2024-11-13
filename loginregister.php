<?php
session_start();
include 'db.php';

// Registration process
if (isset($_POST['register'])) {
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already registered.'); window.history.back();</script>";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO user (firstname, lastname, company, email, password) 
                VALUES ('$first', '$last', '$company', '$email', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful.'); window.location.href = 'user.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    }
}

// Login process
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Retrieve user from database
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['firstname'];
            $_SESSION['last_name'] = $user['lastname'];
            $_SESSION['company'] = $user['company'];
            $_SESSION['email'] = $user['email'];

            // Output JavaScript for alert and redirect
            echo "<script>
                alert('Welcome, " . $_SESSION['first_name'] . "!');
                window.location.href = 'index.php';
            </script>";
            exit;
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.history.back();</script>";
    }
}

// Close the connection
mysqli_close($conn);
?>
