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
            alert("Please log in to keyword-targeting services.");
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
    <title>Keyword Targeting - GrowthGenius</title>
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
            background-color: #fc3549;
            /* Primary accent color */
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
            color: #350b0f;
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
            color: #350b0f;
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
                background-color: #fc3549;
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

        .keyword-targeting .service-details,
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

        .keyword-targeting .service-details:hover,
        .benefits:hover,
        .cta:hover,
        .testimonials:hover,
        .faq:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border-bottom: 2px solid grey;
        }

        .keyword-targeting h3.h3 {
            font-size: 1.8em;
            color: #fc3549;
            /* Updated header color */
            margin-bottom: 15px;
        }

        .keyword-targeting p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6em;
        }

        .keyword-targeting .service-list,
        .benefits-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #333;
            margin-top: 10px;
        }

        .keyword-targeting .service-list li,
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
            color: #fc3549;
            /* Updated FAQ answer color */
            margin-top: 5px;
            transition: all .3s ease;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #fc3549;
            /* Primary button color */
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
            background-color: #791d26;
            /* Darker shade for hover effect */
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
            color: #fc3549;
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
        <section class="section keyword-targeting" id="keyword-targeting" aria-label="Keyword Targeting Services">
            <div class="container">
                <h2 class="h2 section-title">Keyword Targeting Services</h2>
                <p class="section-text">Unlock the full potential of your online presence with our expert Keyword Targeting services at GrowthGenius.</p>

                <div class="service-details">
                    <h3 class="h3">Our Keyword Targeting Strategy</h3>
                    <p>Our keyword targeting strategy is designed to help you enhance your visibility and reach your target audience effectively. We implement a range of techniques, including:</p>
                    <ul class="service-list">
                        <li><strong>Comprehensive Keyword Research</strong>: Identifying relevant keywords that align with your business goals and audience interests.</li>
                        <li><strong>Competitor Keyword Analysis</strong>: Assessing the keywords your competitors are targeting to uncover opportunities for your brand.</li>
                        <li><strong>On-Page Optimization</strong>: Optimizing your website content to rank for selected keywords and enhance user experience.</li>
                        <li><strong>Performance Tracking</strong>: Monitoring the effectiveness of targeted keywords and making adjustments as necessary.</li>
                    </ul>
                </div>

                <div class="benefits">
                    <h3 class="h3">Why Choose GrowthGenius for Keyword Targeting?</h3>
                    <p>We leverage data-driven insights to provide actionable recommendations. Here’s how we ensure your keyword targeting delivers measurable value:</p>
                    <ul class="benefits-list">
                        <li><strong>Increased Organic Traffic</strong>: Targeted keywords lead to higher visibility in search results, driving more traffic to your site.</li>
                        <li><strong>Improved Conversion Rates</strong>: Attracting qualified leads that are more likely to convert into customers.</li>
                        <li><strong>Enhanced Brand Awareness</strong>: Positioning your brand prominently in search results to build trust and recognition.</li>
                        <li><strong>Customized Keyword Strategies</strong>: Tailored methodologies designed specifically for your business goals and industry.</li>
                        <li><strong>Data-Driven Decisions</strong>: Empowering your team with information that supports strategic planning and execution.</li>
                        <li><strong>Ongoing Performance Analysis</strong>: Regularly reviewing keyword performance to ensure maximum effectiveness.</li>
                        <li><strong>Cost-Effective Solutions</strong>: Efficient targeting strategies that maximize your return on investment.</li>
                    </ul>
                </div>

                <div class="testimonials">
                    <h3 class="h3">What Our Clients Say</h3>
                    <div class="testimonial-item">
                        <p>"GrowthGenius’s keyword targeting strategy has been a game-changer. We’ve seen a noticeable jump in qualified leads!"</p>
                        <span class="client-name">- Priya Sharma</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Their keyword research helped us uncover niche terms we hadn’t considered, bringing in more engaged visitors than ever."</p>
                        <span class="client-name">- Rakesh Verma</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Thanks to GrowthGenius, our site now ranks for high-impact keywords that drive relevant traffic straight to our business."</p>
                        <span class="client-name">- Sneha Iyer</span>
                    </div>
                </div>


                <div class="faq">
                    <h3 class="h3">Frequently Asked Questions about Keyword Targeting</h3>
                    <div class="faq-item">
                        <div class="faq-question">1. What is keyword targeting?</div>
                        <div class="faq-answer">Ans: Keyword targeting is the process of researching and selecting specific keywords that potential customers use in search engines to find your products or services, ensuring that your content is optimized for those terms.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">2. How can I identify the right keywords for my business?</div>
                        <div class="faq-answer">Ans: You can identify the right keywords by keyword-targeting tools like Google Keyword Planner or SEMrush. Look for keywords with high search volume and relevance to your offerings, considering both short-tail and long-tail options.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">3. Why is long-tail keyword targeting important?</div>
                        <div class="faq-answer">Ans: Long-tail keywords are typically more specific and have less competition, making it easier to rank higher in search results. They often attract more qualified traffic, leading to higher conversion rates.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">4. How often should I update my keyword strategy?</div>
                        <div class="faq-answer">Ans: You should review and update your keyword strategy regularly, at least every 3 to 6 months, to ensure it remains aligned with changing trends, customer behavior, and search engine algorithms.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">5. How does keyword targeting impact SEO?</div>
                        <div class="faq-answer">Ans: Effective keyword targeting enhances your SEO by improving your website's visibility in search results. It helps search engines understand your content, leading to better rankings and increased organic traffic.</div>
                    </div>
                </div>


                <div class="cta">
                    <p>Ready to enhance your online presence? Partner with GrowthGenius to achieve effective keyword targeting success.</p>
                    <a href="keywordtargetingform.php" class="btn btn-primary">Get Started with Keyword Targeting</a>
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