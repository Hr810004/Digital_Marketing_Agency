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
            alert("Please log in to access SEO services.");
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
    <title>SEO Optimization - GrowthGenius</title>
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
            background-color: #13c4a1;
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
            color: rgb(8, 75, 61);
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
            color: #0b5047;
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
            color: #fff;
        }

        /* Logout Icon Styling */
        .clientname .bx-power-off {
            position: absolute;
            top: -3px;
            margin-left: 10px;
            font-size: 1em;
            color: #0b5047;
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
                background-color: #13c4a1;
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

        /* SEO Service Section */
        .seo-service .service-details,
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

        .seo-service .service-details:hover,
        .benefits:hover,
        .cta:hover,
        .testimonials:hover,
        .faq:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border-bottom: 2px solid grey;
        }


        .seo-service h3.h3 {
            font-size: 1.8em;
            color: #13c4a1;
            margin-bottom: 15px;
        }

        .seo-service p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6em;
        }

        .seo-service .service-list,
        .benefits-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #333;
            margin-top: 10px;
        }

        .seo-service .service-list li,
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
            color: #0b5047;
            margin-top: 5px;
            transition: all .3s ease;
        }

        .btn-primary {
            background-color: #13c4a1;
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
            background-color: #10a387;
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
            color: #13c4a1;
            /* Updated footer link color */
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Hover Effects for Cards */
        .card:hover .card-icon {
            background-color: #00a48e;
        }

        .card:hover .card-title {
            color: #13c4a1;
            transition: color 0.3s;
        }

        .card-title:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.5s ease-in-out forwards;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header .navbar-list {
                flex-direction: column;
                gap: 10px;
            }

            .seo-service,
            .service-details,
            .benefits,
            .cta {
                padding: 20px;
            }

            .h2.section-title {
                font-size: 1.8em;
            }

            .seo-service h3.h3 {
                font-size: 1.5em;
            }
        }

        body {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body id="top">

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

    <!-- Main Content -->
    <main>
        <section class="section seo-service" id="seo-service" aria-label="SEO Optimization">
            <div class="container">
                <h2 class="h2 section-title">SEO Optimization</h2>
                <p class="section-text">Enhance your online presence and improve your website's ranking with our comprehensive SEO optimization services at GrowthGenius.</p>

                <div class="service-details">
                    <h3 class="h3">Our SEO Strategy</h3>
                    <p>Our SEO strategy is designed to boost your website’s organic visibility and traffic. We implement a range of techniques, including:</p>
                    <ul class="service-list">
                        <li><strong>Keyword Research</strong>: Identifying high-impact keywords for your niche to drive relevant traffic.</li>
                        <li><strong>On-Page Optimization</strong>: Fine-tuning website elements like title tags, meta descriptions, and content structure.</li>
                        <li><strong>Technical SEO</strong>: Improving site performance and structure, ensuring faster loading times and crawlability.</li>
                        <li><strong>Link Building</strong>: Building a solid backlink profile to establish your site’s authority and credibility.</li>
                    </ul>
                </div>


                <div class="benefits">
                    <h3 class="h3">Why Choose GrowthGenius for SEO?</h3>
                    <p>We leverage data-driven insights to deliver exceptional SEO results. Here’s how we ensure measurable success for your business:</p>
                    <ul class="benefits-list">
                        <li><strong>Proven Track Record</strong>: A history of success in driving organic traffic and increasing SERP rankings.</li>
                        <li><strong>Customized Approach</strong>: Tailored SEO strategies designed specifically for your industry and audience.</li>
                        <li><strong>Comprehensive Reporting</strong>: Detailed reports to keep you updated on performance and improvements.</li>
                        <li><strong>Increased Website Traffic</strong>: Our strategies are focused on bringing more visitors to your site.</li>
                        <li><strong>Higher Search Engine Rankings</strong>: We implement techniques that enhance your visibility on search engines.</li>
                        <li><strong>Better User Experience</strong>: Optimized sites that improve visitor engagement and retention.</li>
                        <li><strong>Cost-Effective Marketing</strong>: SEO provides long-term marketing benefits without ongoing ad spend.</li>
                    </ul>
                </div>
                <div class="testimonials">
                    <h3 class="h3">What Our Clients Say</h3>
                    <div class="testimonial-item">
                        <p>"GrowthGenius transformed our website traffic!"</p>
                        <span class="client-name">- Priya Sharma</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Their SEO strategies have significantly improved our rankings."</p>
                        <span class="client-name">- Arjun Patel</span>
                    </div>
                    <div class="testimonial-item">
                        <p>"Fantastic service and support! Highly recommend."</p>
                        <span class="client-name">- Neha Gupta</span>
                    </div>
                </div>
                <div class="faq">
                    <h3 class="h3">Frequently Asked Questions</h3>
                    <div class="faq-item">
                        <div class="faq-question">1. What is SEO?</div>
                        <div class="faq-answer">Ans: SEO stands for Search Engine Optimization, which is the practice of enhancing a website to improve its visibility on search engines.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">2. How long does it take to see results from SEO?</div>
                        <div class="faq-answer">Ans: Results can vary based on various factors, but typically, it takes 3-6 months to start seeing significant improvements.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">3. Is SEO really necessary?</div>
                        <div class="faq-answer">Ans: Yes, SEO is crucial for increasing your website's visibility and attracting organic traffic, which can lead to more conversions.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">4. Can I do SEO myself?</div>
                        <div class="faq-answer">Ans: While it's possible to learn and implement SEO on your own, working with professionals can yield better results.</div>
                    </div>
                </div>

                <div class="cta">
                    <p>Ready to climb the ranks on Google? Partner with GrowthGenius to achieve sustainable SEO success.</p>
                    <a href="seoform.php" class="btn btn-primary">Get Started with SEO</a>
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
        // FAQ Toggle Functionality
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
    <!-- Ionicons for Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>