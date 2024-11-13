<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'growthgenius');

// Check if connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, show alert and redirect
    echo '<script>
            alert("Please log in to access digital marketing services.");
            window.location.href = "user.php";
          </script>';
    exit(); // Stop further script execution
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Marketing - GrowthGenius</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Basic Global Styles */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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

        /* Header Styles */
        .header {
            background-color: #6610f2;
            /* Changed color */
            color: white;
            /* Updated text color for contrast */
            padding: 20px 0;
            position: sticky;
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
            color: #1d132e;
            /* Updated text color for contrast */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .header .logo:hover {
            color: #e0e0e0;
            /* Updated hover color */
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
            color: #1d132e;
            /* Updated link color */
            text-decoration: none;
            font-weight: 600;
            font-size: 1.03em;
            transition: color 0.3s ease;
        }

        .navbar-link:hover {
            color: white;
            /* Updated hover color */
        }

        /* Welcome Message */
        .clientname .welcome {
            position: absolute;
            font-size: 1.1em;
            font-weight: 600;
            top: 60px;
            right: 60px;
            color: #fff;
        }

        /* Logout Icon Styling */
        .clientname .bx-power-off {
            position: absolute;
            top: -3px;
            margin-left: 10px;
            font-size: 1em;
            color: #170f25;
            /* Updated icon color */
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .clientname .bx-power-off:hover {
            color: white;
            /* Updated hover color */
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
            /* Updated hover color */
        }

        @media (max-width: 768px) {

            /* Mobile Navbar */
            .navbar {
                display: none;
                flex-direction: column;
                align-items: flex-start;
                background-color: #6610f2;
                /* Changed color */
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

        /* Section Titles */
        .h2.section-title {
            font-size: 2.5em;
            color: #333;
            margin: 20px 0;
            text-align: center;
        }

        .section-text {
            color: #666;
            font-size: 1.1em;
            text-align: center;
            margin-bottom: 40px;
        }

        /* Digital Marketing Section */
        .digital-marketing .service-details,
        .benefits,
        .cta,
        .testimonials,
        .faq {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .digital-marketing .service-details:hover,
        .benefits:hover,
        .cta:hover,
        .testimonials:hover,
        .faq:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border-bottom: 2px solid grey;
        }

        .digital-marketing h3.h3 {
            font-size: 1.8em;
            color: #6610f2;
            /* Changed color */
            margin-bottom: 15px;
        }

        .digital-marketing p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6em;
        }

        .digital-marketing .service-list,
        .benefits-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #333;
            margin-top: 10px;
        }

        .digital-marketing .service-list li,
        .benefits-list li {
            font-size: 1em;
            color: #555;
            margin: 8px 0;
            line-height: 1.5em;
        }

        .testimonial-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .faq-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .faq-question {
            font-weight: 600;
            cursor: pointer;
        }

        .faq-answer {
            font-weight: 600;
            color: #32087b;
            margin-top: 5px;
            transition: all .3s ease;
        }

        .btn-primary {
            background-color: #6610f2;
            /* Changed button color */
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            padding: 12px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #3e1383;
            /* Darker shade for hover effect */
            transform: scale(1.05);
        }

        /* Footer Styling */
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .footer p {
            margin: 10px 0;
            font-size: 0.9em;
        }

        .footer a {
            color: #6610f2;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
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

    <main>
        <section class="section digital-marketing" id="digital-marketing" aria-label="Digital Marketing Services">
            <div class="container">
                <h2 class="h2 section-title">Digital Marketing Services</h2>
                <p class="section-text">Enhance your online presence and drive business growth with our comprehensive digital marketing services at GrowthGenius.</p>

                <div class="service-details">
                    <h3 class="h3">Our Digital Marketing Strategy</h3>
                    <p>Our digital marketing strategy is designed to boost your brand's online visibility and engagement. We implement a range of techniques, including:</p>
                    <ul class="service-list">
                        <li><strong>SEO Optimization</strong>: Improving your website's search engine ranking to increase organic traffic.</li>
                        <li><strong>Content Marketing</strong>: Creating valuable content to attract and engage your target audience.</li>
                        <li><strong>Social Media Management</strong>: Building and managing your brand’s presence on social platforms.</li>
                        <li><strong>Email Marketing</strong>: Crafting targeted email campaigns to convert leads into customers.</li>
                    </ul>
                </div>

                <div class="benefits">
                    <h3 class="h3">Why Choose GrowthGenius for Digital Marketing?</h3>
                    <p>We leverage data-driven insights to deliver exceptional results. Here’s how we ensure measurable success for your business:</p>
                    <ul class="benefits-list">
                        <li><strong>Proven Track Record</strong>: A history of success in increasing brand awareness and customer engagement.</li>
                        <li><strong>Customized Strategies</strong>: Tailored marketing plans designed specifically for your industry and audience.</li>
                        <li><strong>Comprehensive Reporting</strong>: Detailed analytics to keep you updated on performance and improvements.</li>
                        <li><strong>Increased Brand Awareness</strong>: Strategies focused on growing your online visibility and reputation.</li>
                        <li><strong>Better ROI</strong>: Our marketing strategies are designed to maximize your return on investment.</li>
                        <li><strong>Engaged Audience</strong>: We help you connect with your audience effectively and authentically.</li>
                        <li><strong>Cost-Effective Marketing</strong>: Digital marketing offers long-term benefits without the need for ongoing ad spend.</li>
                    </ul>
                </div>

                <div class="testimonials">
                    <h3 class="h3">What Our Clients Say</h3>
                    <div class="testimonial-item">
                        <p>"Thanks to GrowthGenius, our sales have skyrocketed! Their expertise made all the difference."</p>
                        <span class="client-name">- Rahul Desai</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"The team at GrowthGenius crafted a marketing strategy that truly resonates with our audience."</p>
                        <span class="client-name">- Aisha Khan</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Exceptional service! Our brand visibility has increased tremendously since we started working with them."</p>
                        <span class="client-name">- Vikram Mehta</span>
                    </div>
                </div>


                <div class="faq">
                    <h3 class="h3">Frequently Asked Questions</h3>
                    <div class="faq-item">
                        <div class="faq-question">1. What is digital marketing?</div>
                        <div class="faq-answer">Ans: Digital marketing refers to marketing strategies that use digital channels to reach consumers.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">2. How can digital marketing help my business?</div>
                        <div class="faq-answer">Ans: It increases your brand's visibility, engages your audience, and drives conversions.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">3. How long does it take to see results from digital marketing?</div>
                        <div class="faq-answer">Ans: Results can vary, but typically, you can see noticeable improvements within a few months.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">4. Can I do digital marketing myself?</div>
                        <div class="faq-answer">Ans: While you can manage some aspects, working with professionals often leads to better results.</div>
                    </div>
                </div>

                <div class="cta">
                    <p>Ready to boost your online presence? Partner with GrowthGenius to achieve sustainable digital marketing success.</p>
                    <a href="digitalmarketingform.php" class="btn btn-primary">Get Started with Digital Marketing</a>
                </div>
            </div>
        </section>
    </main>


    <footer class="footer">
        <div class="container">
            &copy; 2024 All Rights Reserved by <a href="https://harsh810.vercel.app/" target="_blank" class="copyright-link">Harsh810004</a>
        </div>
    </footer>

    <script>
        // Mobile Navigation Toggle
        const navToggleBtn = document.querySelector('.nav-toggle-btn');
        const navbar = document.querySelector('.navbar');

        navToggleBtn.addEventListener('click', () => {
            navToggleBtn.classList.toggle('active');
            navbar.style.display = navbar.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
    <script>
        // FAQ Toggle Functionality
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>

</html>