<?php
// Start the session
session_start();

// Include database connection
include('db.php'); // Ensure this file contains your DB connection code

// Check if user data is stored in the session
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
$lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
$companyName = isset($_SESSION['company']) ? $_SESSION['company'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $strategyDescription = $_POST['strategy_description'];
    $techniques = $_POST['techniques'];
    $budget = $_POST['budget'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // Prepare and execute insert query
    $query = "INSERT INTO market_research (first_name, last_name, company_name, email, strategy_description, techniques, budget, start_date, end_date) VALUES ('$firstName', '$lastName', '$companyName', '$email', '$strategyDescription', '$techniques', '$budget', '$startDate', '$endDate')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Form submission successful
        echo "<script>alert('Market Research details submitted successfully. Our Team will contact you soon');</script>";
    } else {
        // Error during query execution
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Market Research Form | GrowthGenius</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
    <style>
        /* Basic Global Styles */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'League Spartan';
        }

        body {
            font-family: 'League Spartan';
            font-size: 20px;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        body {
            background: url(assets/images/market&research.jpg);
            background-size: cover;
            background-position: center;    
        }

        /* Header Styles */
        .header {
            background-color: #ffb700;
            color: black;
            padding: 20px 0;
            position: sticky;
            /* border-bottom: 1px solid black; */
            border-bottom-left-radius: 7%;
            border-bottom-right-radius: 7%;
            top: 0px;
            z-index: 1000;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .logo {
            font-size: 1.8em;
            font-weight: 700;
            color: rgb(94, 70, 11);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .header .logo:hover {
            color: black;
        }

        .navbar {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-list {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 0;
        }

        .navbar-link {
            color: rgb(94, 70, 11);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.03em;
            transition: color 0.3s ease;
        }

        .navbar-link:hover {
            color: black;
        }

        /* Welcome Message */
        .clientname .welcome {
            position: absolute;
            font-size: 1.1em;
            font-weight: 600;
            top: 60px;
            right: 60px;
            color: rgb(94, 70, 11);
        }

        /* Logout Icon Styling */
        .clientname .bx-power-off {
            position: absolute;
            top: -3px;
            margin-left: 10px;
            font-size: 1em;
            color: rgb(94, 70, 11);
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .clientname .bx-power-off:hover {
            color: black;
        }

        /* Toggle Button for Mobile */
        .nav-toggle-btn {
            display: none;
            font-size: 1.5em;
            color: #fff;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .nav-toggle-btn:hover {
            color: #e0e0e0;
        }

        @media (max-width: 768px) {

            /* Mobile Navbar */
            .navbar {
                display: none;
                flex-direction: column;
                align-items: flex-start;
                background-color: #ffb700;
                width: 100%;
                position: absolute;
                top: 100%;
                left: 0;
                padding: 15px 0;
            }

            .navbar-list {
                flex-direction: column;
                gap: 10px;
            }

            .nav-toggle-btn {
                display: inline-block;
            }

            /* Mobile Navbar Toggler */
            .nav-toggle-btn[data-nav-toggler="open"] .open {
                display: inline;
            }

            .nav-toggle-btn[data-nav-toggler="close"] .close {
                display: none;
            }

            .nav-toggle-btn.active[data-nav-toggler="close"] .close {
                display: inline;
            }

            .nav-toggle-btn.active[data-nav-toggler="open"] .open {
                display: none;
            }
        }

        body {
            scroll-behavior: smooth;
        }

        /* SEO Form Styling */
        .form-box {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.589);
            border-radius: 8px;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.721);
        }

        .form-box h2 {
            text-align: center;
            color: white;
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-box label {
            display: block;
            font-size: 1em;
            font-weight: 600;
            color: #fcfcfc;
            margin-bottom: 8px;
        }

        .form-box .input-field {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
            margin-bottom: 20px;
        }

        .form-box .input-field:focus {
            border-color: #ffb700;
        }

        .form-box textarea.input-field {
            resize: vertical;
            min-height: 100px;
        }

        .form-box .submit {
            width: 100%;
            padding: 12px;
            background-color: #ffb700;
            color: white;
            font-size: 1.2em;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-box .submit:hover {
            background-color: rgb(153, 125, 55);
            color: white;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
            border-top-left-radius: 7%;
            border-top-right-radius: 7%;
        }

        .footer a {
            color: #ffb700;
            /* Updated footer link color */
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header class="header" data-header>
            <div class="container" style="max-width: 1250px;">

                <a href="#" class="logo">GrowthGenius</a>

                <nav class="navbar container" data-navbar>
                    <ul class="navbar-list">

                        <li>
                            <a href="index.php" class="navbar-link" data-nav-link>Home</a>
                        </li>

                        <li>
                            <a href="index.php#service" class="navbar-link" data-nav-link>Services</a>
                        </li>

                        <li>
                            <a href="index.php#project" class="navbar-link" data-nav-link>Project</a>
                        </li>

                        <li>
                            <a href="index.php#about" class="navbar-link" data-nav-link>About Us</a>
                        </li>

                        <li>
                            <a href="index.php#blog" class="navbar-link" data-nav-link>Blog</a>
                        </li>

                        <li>
                            <a href="index.php#contact" class="navbar-link" data-nav-link>Contact Us</a>
                        </li>

                        <li>
                            <!-- <a href="#service" class="btn btn-primary" id="getStartedBtn">Get Started</a> -->
                        </li>
                        <li class="clientname">
                            <?php if (isset($_SESSION['first_name'])) { ?>
                                <span class="welcome" style="color: black; font-weight:600;">Welcome, <?php echo $_SESSION['first_name']; ?>! <a href="logout.php"><i class='bx bx-power-off'></i></a></span>
                            <?php } else { ?>
                                <span class="welcome" style="color: black; font-weight:600;">Welcome Client!</span>
                            <?php } ?>
                        </li>


                    </ul>
                </nav>

                <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
                    <ion-icon name="menu-outline" class="open"></ion-icon>
                    <ion-icon name="close-outline" class="close"></ion-icon>
                </button>

            </div>
        </header>

        <!-- SEO Form Box -->
        <div class="form-box">
            <form action="marketresearchform.php" method="POST">
                <h2>Market Research Details</h2>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" class="input-field" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>" readonly>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" class="input-field" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>" readonly>

                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" class="input-field" name="company_name" value="<?php echo htmlspecialchars($companyName); ?>" readonly>

                <label for="email">Email Address:</label>
                <input type="email" id="email" class="input-field" name="email" value="<?php echo htmlspecialchars($email); ?>">

                <label for="strategy_description">Strategy Description:</label>
                <textarea id="strategy_description" class="input-field" name="strategy_description" required></textarea>

                <label for="techniques">Techniques:</label>
                <textarea id="techniques" class="input-field" name="techniques" required></textarea>

                <label for="budget">Budget for Market Research:</label>
                <input type="number" id="budget" class="input-field" name="budget" pattern="^\d+(\.\d{1,2})?$" title="Please enter budget in digits only" required>

                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" class="input-field" name="start_date" required>

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" class="input-field" name="end_date" required>

                <input type="submit" value="Submit" class="submit">
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            &copy; 2024 All Rights Reserved by <a href="https://harsh810.vercel.app/" target="_blank" class="copyright-link">Harsh810004</a>
        </div>
    </footer>

</body>

</html>