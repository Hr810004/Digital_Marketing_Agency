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
            alert("Please log in to marketing-reporting services.");
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
    <title>Marketing & Reporting - GrowthGenius</title>
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
            background-color: #ff612f;
            /* Updated primary accent color */
            color: white;
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
            color: #411508;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .header .logo:hover {
            color: black;
            /* Lighter shade for hover effect */
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
            color: #411508;
            /* Color for links */
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05em;
            transition: color 0.3s ease;
        }

        .navbar-link:hover {
            color: black;
            /* Lighter shade on hover */
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
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .clientname .bx-power-off:hover {
            color: white;
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
                background-color: #ff612f;
                /* Updated background color */
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

        .marketing-reporting .service-details,
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

        .marketing-reporting .service-details:hover,
        .benefits:hover,
        .cta:hover,
        .testimonials:hover,
        .faq:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border-bottom: 2px solid grey;
            /* Added border */
        }

        .marketing-reporting h3.h3 {
            font-size: 1.8em;
            color: #ff612f;
            /* Updated header color */
            margin-bottom: 15px;
        }

        .marketing-reporting p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6em;
        }

        .marketing-reporting .service-list,
        .benefits-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #333;
            margin-top: 10px;
        }

        .marketing-reporting .service-list li,
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
            color: #ff612f;
            /* Updated FAQ answer color */
            margin-top: 5px;
            transition: all .3s ease;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #ff612f;
            /* Updated primary button color */
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
            background-color: #96391d;
            /* Keeping the hover color the same for now */
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
            color: #ff612f;
            /* Updated footer link color */
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        html {
            scroll-behavior: smooth;
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
        <section class="section marketing-reporting" id="marketing-reporting" aria-label="Marketing and Reporting Services">
            <div class="container">
                <h2 class="h2 section-title">Marketing and Reporting Services</h2>
                <p class="section-text">Optimize your marketing efforts with GrowthGenius’s data-driven Marketing and Reporting services, designed to maximize your reach and impact.</p>

                <div class="service-details">
                    <h3 class="h3">Our Marketing and Reporting Strategy</h3>
                    <p>Our approach to marketing and reporting ensures that your strategies are aligned with measurable goals and are continuously optimized. We utilize several techniques, including:</p>
                    <ul class="service-list">
                        <li><strong>Targeted Campaign Development</strong>: Creating customized marketing campaigns that engage the right audience and drive desired outcomes.</li>
                        <li><strong>Competitive Analysis</strong>: Studying competitor campaigns and reporting methods to identify opportunities for improvement and differentiation.</li>
                        <li><strong>Data-Driven Content Creation</strong>: Crafting content and messaging backed by analytics to increase relevance and engagement.</li>
                        <li><strong>Performance Tracking and Reporting</strong>: Monitoring key performance metrics across campaigns to optimize reach, engagement, and ROI.</li>
                    </ul>
                </div>

                <div class="benefits">
                    <h3 class="h3">Why Choose GrowthGenius for Marketing and Reporting?</h3>
                    <p>We provide transparent and actionable insights to help you make data-backed decisions. Here’s what makes our marketing and reporting effective:</p>
                    <ul class="benefits-list">
                        <li><strong>Enhanced Campaign Performance</strong>: Targeted marketing initiatives designed to maximize audience reach and engagement.</li>
                        <li><strong>Increased Conversion Rates</strong>: Focusing on metrics that matter to drive conversions and business growth.</li>
                        <li><strong>Improved Brand Positioning</strong>: Establishing a distinct brand presence through consistent and strategic communication.</li>
                        <li><strong>Customized Reporting Solutions</strong>: Reports tailored to reflect the most relevant KPIs and insights for your business.</li>
                        <li><strong>Data-Driven Strategies</strong>: Empowering your team with the insights needed to guide strategy and tactical decisions.</li>
                        <li><strong>Ongoing Performance Analysis</strong>: Regularly tracking performance metrics to ensure continuous improvement and ROI maximization.</li>
                        <li><strong>Cost-Effective Campaign Management</strong>: Efficient strategies that maximize your marketing and reporting investment.</li>
                    </ul>
                </div>

                <div class="testimonials">
                    <h3 class="h3">What Our Clients Say</h3>
                    <div class="testimonial-item">
                        <p>"GrowthGenius's marketing insights helped us fine-tune our strategies and achieve much higher engagement rates!"</p>
                        <span class="client-name">- Sunita Malhotra</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Their reporting was comprehensive and easy to understand, enabling us to make data-backed improvements across our campaigns."</p>
                        <span class="client-name">- Ajay Pillai</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Thanks to GrowthGenius, we now have clear, actionable insights that continuously guide our marketing efforts."</p>
                        <span class="client-name">- Kavita Joshi</span>
                    </div>
                </div>

                <div class="faq">
                    <h3 class="h3">Frequently Asked Questions about Marketing and Reporting</h3>
                    <div class="faq-item">
                        <div class="faq-question">1. What are marketing and reporting services?</div>
                        <div class="faq-answer">Ans: These services help businesses optimize their marketing efforts by providing targeted strategies and insights through detailed performance reports.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">2. How can I measure the success of my marketing campaigns?</div>
                        <div class="faq-answer">Ans: Track key performance indicators like engagement rates, conversions, and return on investment (ROI) to assess your campaign’s impact.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">3. Why is competitor analysis important in marketing?</div>
                        <div class="faq-answer">Ans: Understanding competitors' tactics helps identify strengths and areas for differentiation, improving your competitive edge.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">4. How often should I review my marketing reports?</div>
                        <div class="faq-answer">Ans: Regular reviews, often monthly or quarterly, are recommended to ensure your campaigns are aligned with current goals and market conditions.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">5. How does data-driven marketing improve ROI?</div>
                        <div class="faq-answer">Ans: By focusing on metrics that impact business goals, data-driven marketing ensures that resources are effectively allocated to optimize results and ROI.</div>
                    </div>
                </div>

                <div class="cta">
                    <p>Ready to boost your marketing impact? Partner with GrowthGenius for strategic marketing and reporting solutions that drive growth.</p>
                    <a href="market&reportform.php" class="btn btn-primary">Get Started with Marketing and Reporting</a>
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