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
            alert("Please log in to access market research services.");
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
    <title>Market Research - GrowthGenius</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Basic Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'League Spartan', sans-serif;
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
            background-color: #ffb700;
            /* Updated to new color */
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
            color: rgb(94, 70, 11);
            /* Updated text color for contrast */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .header .logo:hover {
            color: black;
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
            color: rgb(94, 70, 11);
            /* Updated link color */
            text-decoration: none;
            font-weight: 600;
            font-size: 1.03em;
            transition: color 0.3s ease;
        }

        .navbar-link:hover {
            color: black;
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
                background-color: #ffb700;
                /* Updated color */
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

        /* Market Research Section */
        .market-research .service-details,
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

        .market-research .service-details:hover,
        .benefits:hover,
        .cta:hover,
        .testimonials:hover,
        .faq:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border-bottom: 2px solid grey;
        }

        .market-research h3.h3 {
            font-size: 1.8em;
            color: #ffb700;
            /* Changed to new color */
            margin-bottom: 15px;
        }

        .market-research p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6em;
        }

        .market-research .service-list,
        .benefits-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #333;
            margin-top: 10px;
        }

        .market-research .service-list li,
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
            color: rgb(94, 70, 11);
            /* Darker shade of yellow for FAQ answer */
            margin-top: 5px;
            transition: all .3s ease;
        }

        .btn-primary {
            background-color: #ffb700;
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
            background-color: rgb(153, 125, 55);
            /* Darker shade used in FAQ answer */
            transform: scale(1.05);
        }

        /* Footer Styling */
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
        <section class="section market-research" id="market-research" aria-label="Market Research Services">
            <div class="container">
                <h2 class="h2 section-title">Market Research Services</h2>
                <p class="section-text">Gain valuable insights into your industry and customers with our expert market research services at GrowthGenius.</p>

                <div class="service-details">
                    <h3 class="h3">Our Market Research Strategy</h3>
                    <p>Our market research strategy is designed to help you understand market dynamics and customer preferences. We implement a range of techniques, including:</p>
                    <ul class="service-list">
                        <li><strong>Survey Analysis</strong>: Collecting and analyzing customer feedback to gain insights into their preferences and behaviors.</li>
                        <li><strong>Focus Groups</strong>: Conducting discussions with target audience members to gather qualitative data about their opinions and motivations.</li>
                        <li><strong>Market Segmentation</strong>: Identifying distinct groups within your target market to tailor marketing efforts effectively.</li>
                        <li><strong>Competitor Analysis</strong>: Assessing competitor strategies to identify opportunities and threats in the market.</li>
                    </ul>
                </div>

                <div class="benefits">
                    <h3 class="h3">Why Choose GrowthGenius for Market Research?</h3>
                    <p>We leverage data-driven insights to provide actionable recommendations. Here’s how we ensure your research delivers measurable value:</p>
                    <ul class="benefits-list">
                        <li><strong>In-Depth Insights</strong>: Comprehensive analysis that uncovers market trends and consumer needs.</li>
                        <li><strong>Customized Research Plans</strong>: Tailored methodologies designed specifically for your business goals and industry.</li>
                        <li><strong>Clear Reporting</strong>: Detailed reports that present findings and actionable strategies in an understandable format.</li>
                        <li><strong>Data-Driven Decisions</strong>: Empowering your team with information that supports strategic planning and execution.</li>
                        <li><strong>Market Trend Identification</strong>: Staying ahead by recognizing emerging trends that could impact your business.</li>
                        <li><strong>Enhanced Customer Understanding</strong>: Fostering deeper connections by knowing your customers' needs and preferences.</li>
                        <li><strong>Cost-Effective Solutions</strong>: Efficient research strategies that maximize your return on investment.</li>
                    </ul>
                </div>

                <div class="testimonials">
                    <h3 class="h3">What Our Clients Say</h3>
                    <div class="testimonial-item">
                        <p>"GrowthGenius provided us with insights that were crucial for our product launch!"</p>
                        <span class="client-name">- Rahul Desai</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Their market research helped us understand our audience better than ever."</p>
                        <span class="client-name">- Aisha Khan</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Thanks to GrowthGenius, we now have a clear view of our competitive landscape."</p>
                        <span class="client-name">- Vikram Mehta</span>
                    </div>
                </div>

                <div class="faq">
                    <h3 class="h3">Frequently Asked Questions</h3>
                    <div class="faq-item">
                        <div class="faq-question">1. What is market research?</div>
                        <div class="faq-answer">Ans: Market research involves gathering, analyzing, and interpreting information about a market, including information about the target audience and competitors.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">2. How can market research benefit my business?</div>
                        <div class="faq-answer">Ans: It provides insights that help you make informed decisions about your products, marketing strategies, and customer engagement.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">3. How long does a market research project take?</div>
                        <div class="faq-answer">Ans: The timeline varies based on the complexity of the project, but most research can be completed within a few weeks.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">4. Can I conduct market research on my own?</div>
                        <div class="faq-answer">Ans: While some aspects can be managed internally, partnering with professionals often yields better insights and more accurate results.</div>
                    </div>
                </div>

                <div class="cta">
                    <p>Ready to uncover valuable insights? Partner with GrowthGenius to achieve comprehensive market research success.</p>
                    <a href="marketresearchform.php" class="btn btn-primary">Get Started with Market Research</a>
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