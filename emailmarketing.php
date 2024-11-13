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
            alert("Please log in to email-marketing services.");
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
    <title>Email Marketing - GrowthGenius</title>
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
            background-color: #00d280;
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
            color: #0c3a28;
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
            color: #0c3a28;
            /* White for high contrast */
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
                background-color: #00d280;
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

        .email-marketing .service-details,
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

        .email-marketing .service-details:hover,
        .benefits:hover,
        .cta:hover,
        .testimonials:hover,
        .faq:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border-bottom: 2px solid grey;
            /* Added border */
        }

        .email-marketing h3.h3 {
            font-size: 1.8em;
            color: #00d280;
            /* Updated header color */
            margin-bottom: 15px;
        }

        .email-marketing p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6em;
        }

        .email-marketing .service-list,
        .benefits-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #333;
            margin-top: 10px;
        }

        .email-marketing .service-list li,
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
            color: #176748;
            /* Updated FAQ answer color */
            margin-top: 5px;
            transition: all .3s ease;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #0d9f67;
            /* Updated primary button color */
            color: white;
            text-decoration: none;
            font-weight: 700;
            padding: 12px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #11764f;
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
            color: #00d280;
            /* Footer link color */
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
        <section class="section email-marketing" id="email-marketing" aria-label="Email Marketing Services">
            <div class="container">
                <h2 class="h2 section-title">Email Marketing Services</h2>
                <p class="section-text">Unlock the full potential of your customer engagement with our expert Email Marketing services at GrowthGenius.</p>

                <div class="service-details">
                    <h3 class="h3">Our Email Marketing Strategy</h3>
                    <p>Our email marketing strategy is crafted to help you connect with your audience and boost conversions effectively. We implement a range of techniques, including:</p>
                    <ul class="service-list">
                        <li><strong>Audience Segmentation</strong>: email-marketing specific customer segments to deliver more relevant and impactful messages.</li>
                        <li><strong>Competitor Analysis</strong>: Assessing competitor email tactics to uncover opportunities to differentiate your brand's approach.</li>
                        <li><strong>Personalized Content Creation</strong>: Crafting tailored email content that resonates with each audience segment and increases engagement.</li>
                        <li><strong>Performance Tracking</strong>: Monitoring email campaign metrics to optimize open rates, click-through rates, and conversions.</li>
                    </ul>
                </div>

                <div class="benefits">
                    <h3 class="h3">Why Choose GrowthGenius for Email Marketing?</h3>
                    <p>We use data-driven insights to provide actionable recommendations. Here’s how we ensure your email marketing delivers measurable value:</p>
                    <ul class="benefits-list">
                        <li><strong>Enhanced Customer Engagement</strong>: Targeted, relevant emails foster stronger connections with your audience.</li>
                        <li><strong>Improved Conversion Rates</strong>: Tailored content attracts engaged recipients more likely to convert into customers.</li>
                        <li><strong>Strengthened Brand Loyalty</strong>: Building customer trust and long-term loyalty through consistent, valuable communication.</li>
                        <li><strong>Customized Campaigns</strong>: Email strategies specifically designed for your unique business objectives and audience.</li>
                        <li><strong>Data-Driven Decisions</strong>: Enabling your team with actionable insights that drive strategy and execution.</li>
                        <li><strong>Ongoing Performance Analysis</strong>: Regularly reviewing campaign metrics to ensure optimal effectiveness and ROI.</li>
                        <li><strong>Cost-Effective Solutions</strong>: Efficient strategies that maximize your email marketing investment.</li>
                    </ul>
                </div>

                <div class="testimonials">
                    <h3 class="h3">What Our Clients Say</h3>
                    <div class="testimonial-item">
                        <p>"GrowthGenius’s email marketing has transformed our customer engagement. We’ve seen a huge boost in open and click-through rates!"</p>
                        <span class="client-name">- Neha Singh</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Their audience segmentation tactics brought in highly relevant leads that have greatly improved our conversion rates."</p>
                        <span class="client-name">- Deepa Rao</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Thanks to GrowthGenius, our email campaigns are not only effective but also perfectly aligned with our brand message."</p>
                        <span class="client-name">- Nikhil Gupta</span>
                    </div>
                </div>


                <div class="faq">
                    <h3 class="h3">Frequently Asked Questions about Email Marketing</h3>
                    <div class="faq-item">
                        <div class="faq-question">1. What is email marketing?</div>
                        <div class="faq-answer">Ans: Email marketing is the process of using email to send targeted messages to current and potential customers to build relationships, promote products, and increase brand loyalty.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">2. How can I improve my email open rates?</div>
                        <div class="faq-answer">Ans: Use compelling subject lines, personalize content, and segment your audience to ensure that recipients receive relevant emails that catch their attention.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">3. Why is audience segmentation important in email marketing?</div>
                        <div class="faq-answer">Ans: Segmenting your audience allows you to deliver tailored messages that resonate with specific groups, increasing engagement and conversion rates.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">4. How often should I send emails to my audience?</div>
                        <div class="faq-answer">Ans: It depends on your audience and content. Generally, a balance of 1-4 emails per month helps maintain engagement without overwhelming your recipients.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">5. How does email marketing support overall digital marketing efforts?</div>
                        <div class="faq-answer">Ans: Email marketing supports broader digital strategies by nurturing leads, strengthening brand loyalty, and driving targeted traffic to your website or other marketing channels.</div>
                    </div>
                </div>

                <div class="cta">
                    <p>Ready to enhance your customer engagement? Partner with GrowthGenius to achieve effective email marketing success.</p>
                    <a href="emailmarketingform.php" class="btn btn-primary">Get Started with Email Marketing</a>
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