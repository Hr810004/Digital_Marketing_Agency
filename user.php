
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Client | Login & Registration | GrowthGenius</title>
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <span style="color: white; font-size: 40px;"><a href="index.php">GrowthGenius</a></span></span>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="index.php" class="link">Home</a></li>
                    <li><a href="index.php#service" class="link">Our Services</a></li>
                    <li><a href="index.php#contact" class="link">Contact Us</a></li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Login</button>
                <button class="btn" id="registerBtn" onclick="register()">Register</button>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <!-- Form Box -->
        <div class="form-box">
            <!-- Login Form -->
            <form action="loginregister.php" method="post">
                <div class="login-container" id="login">
                    <div class="top">
                        <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                        <header>Welcome, Client</header>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" class="input-field" placeholder="Email" required>
                        <i class="bx bxs-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password" required>
                        <i class="bx bxs-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="login" class="submit" value="Sign In">
                    </div>
                </div>
            </form>

            <!-- Registration Form -->
            <form action="loginregister.php" method="post">
                <div class="register-container" id="register">
                    <div class="top">
                        <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                        <header>Client Registration</header>
                    </div>
                    <div class="input-box">
                        <input type="text" name="first" class="input-field" placeholder="Firstname" required pattern="[A-Za-z]{1,}" title="Firstname must contain only letters.">
                        <i class="bx bxs-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="last" class="input-field" placeholder="Lastname" required pattern="[A-Za-z]{1,}" title="Lastname must contain only letters.">
                        <i class="bx bxs-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="company" class="input-field" placeholder="Company Name" required pattern="[A-Za-z0-9 ]{1,}" title="Company Name can only contain letters, numbers, and spaces.">
                        <i class="bx bxs-building-house"></i>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" class="input-field" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address (e.g., user@example.com)" required>
                        <i class="bx bxs-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password"
                            pattern="[a-zA-Z@$0-9]{10}" title="Password must be 10 characters long and may include letters, numbers, and special characters (@, $)." maxlength="10" required>
                        <i class="bx bxs-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password"
                            pattern="[a-zA-Z@$0-9]{10}"
                            title="Confirm Password must match the password."
                            maxlength="10" required>
                        <i class="bx bxs-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" name="register" value="Register">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="copy">&copy; 2024 GrowthGenius. All Rights Reserved.</div>
    </footer>
    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");

            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>

    <script>
        var a = document.getElementById("loginBtn");
        var b = document.getElementById("registerBtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function login() {
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }

        function register() {
            x.style.left = "-520px";
            y.style.right = "4px";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>
    <script src="assets/js/script.js"></script>
</body>

</html>