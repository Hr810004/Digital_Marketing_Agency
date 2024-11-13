<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'growthgenius');

// Check if connection is successful
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GrowthGenius - We're available for marketing</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body id="top">

  <header class="header" data-header>
    <div class="container" style="max-width: 1250px;">

      <a href="#" class="logo">GrowthGenius</a>

      <nav class="navbar container" data-navbar>
        <ul class="navbar-list">

          <li>
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li>
            <a href="#service" class="navbar-link" data-nav-link>Services</a>
          </li>

          <li>
            <a href="#project" class="navbar-link" data-nav-link>Project</a>
          </li>

          <li>
            <a href="#about" class="navbar-link" data-nav-link>About Us</a>
          </li>

          <li>
            <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
          </li>

          <li>
            <a href="#contact" class="navbar-link" data-nav-link>Contact Us</a>
          </li>

          <li>
            <!-- <a href="#service" class="btn btn-primary" id="getStartedBtn">Get Started</a> -->
          </li>
          <li class="clientname">
            <?php
            if (isset($_SESSION['first_name'])) {
            ?>
              <span class="welcome" style="color: black; font-weight:600;">Welcome, <?php echo $_SESSION['first_name']; ?> !</span>
          <li>
            <a href="logout.php"><i class='bx bx-power-off'></i></a>
          </li> 
        <?php
            } else {
        ?>
          <span class="welcome" style="color: black; font-weight:600;">Welcome Client!</span>
        <?php
            }
        ?>
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
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero" id="home" aria-label="hero">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">GrowthGenius Marketing Agency</p>

            <h1 class="h1 hero-title">We are available for marketing</h1>

            <p class="hero-text">
              At GrowthGenius, we specialize in driving growth through innovative marketing strategies. From digital campaigns to
              brand development, we tailor our services to help businesses expand their reach, attract more customers, and achieve
              sustainable success in today’s competitive market.
            </p>

            <a href="#service" class="btn btn-primary" id="getStartedBtn">Get Started</a>

          </div>

          <figure class="hero-banner">
            <img src="./assets/images/hero-banner.png" width="720" height="673" alt="hero banner" class="w-100">
          </figure>

        </div>
      </section>

      <!-- 
        - #SERVICE
      -->

      <section class="section service" id="service" aria-label="service">
        <div class="container">

          <h2 class="h2 section-title">Services We Provide</h2>

          <p class="section-text">
            At GrowthGenius, we offer a full suite of marketing services designed to boost your brand's visibility, drive
            targeted traffic, and convert leads into loyal customers. Explore our specialized services below.
          </p>

          <ul class="grid-list">

            <li>
              <div class="service-card">

                <div class="card-icon" style="background-color: #13c4a1">
                  <ion-icon name="chatbox"></ion-icon>
                </div>

                <h3 class="h3">
                  <a href="seo.php" class="card-title">SEO Optimization</a>
                </h3>

                <p class="card-text">
                  Improve your website's search engine ranking with our SEO optimization services. We use proven strategies to
                  increase organic traffic and enhance your online presence.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon" style="background-color: #6610f2">
                  <ion-icon name="desktop"></ion-icon>
                </div>

                <h3 class="h3">
                  <a href="digitalmarketing.php" class="card-title">Digital Marketing</a>
                </h3>

                <p class="card-text">
                  From social media management to pay-per-click (PPC) campaigns, we develop targeted digital marketing strategies
                  that drive engagement and deliver measurable results.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon" style="background-color: #ffb700">
                  <ion-icon name="bulb"></ion-icon>
                </div>

                <h3 class="h3">
                  <a href="marketresearch.php" class="card-title">Market Research</a>
                </h3>

                <p class="card-text">
                  Understand your audience better with our comprehensive market research. We analyze market trends and customer
                  behavior to provide actionable insights for your business.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon" style="background-color: #fc3549">
                  <ion-icon name="phone-portrait"></ion-icon>
                </div>

                <h3 class="h3">
                  <a href="keywordtargeting.php" class="card-title">Keyword Targeting</a>
                </h3>

                <p class="card-text">
                  Maximize your visibility with our keyword targeting strategies. We identify the most relevant keywords for
                  your niche to ensure your content reaches the right audience.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon" style="background-color: #00d280">
                  <ion-icon name="archive"></ion-icon>
                </div>

                <h3 class="h3">
                  <a href="emailmarketing.php" class="card-title">Email Marketing</a>
                </h3>

                <p class="card-text">
                  Connect with your customers directly through email marketing. We design personalized email campaigns that
                  foster engagement and drive conversions.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon" style="background-color: #ff612f">
                  <ion-icon name="build"></ion-icon>
                </div>

                <h3 class="h3">
                  <a href="market&report.php" class="card-title">Marketing & Reporting</a>
                </h3>

                <p class="card-text">
                  Track your success with our detailed marketing reports. We provide insights on campaign performance, helping
                  you optimize and scale your marketing efforts effectively.
                </p>

              </div>
            </li>

          </ul>

        </div>
      </section>


      <!-- 
        - #PROJECT
      -->

      <section class="section project" id="project" aria-label="project">
        <div class="container">

          <h2 class="h2 section-title">Our Recent Projects</h2>

          <p class="section-text">
            Take a look at some of our recent success stories, where we helped businesses grow through innovative marketing
            strategies, data-driven campaigns, and cutting-edge technology.
          </p>

          <ul class="grid-list">

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 510; --height: 700;">
                  <img src="./assets/images/project-1.jpg" width="510" height="700" loading="lazy"
                    alt="Boosting traffic for a cinema chain" class="img-cover">
                </figure>

                <div class="card-content">

                  <p class="card-subtitle" style="color: white;">SEO Optimization</p>
                  <h3 class="h3">
                    <a href="https://thatware.co/seo-services-movie-reviews/" target="_blank" class="card-title">Boosting traffic for a cinema chain</a>
                  </h3>

                  <p class="card-text" style="color: white;">We optimized on-page SEO and created a content strategy that increased organic search
                    traffic by 35% for this cinema chain, resulting in a surge in bookings.</p>

                  <a href="https://thatware.co/seo-services-movie-reviews/" target="_blank" class="btn btn-primary">View Details</a>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 510; --height: 700;">
                  <img src="./assets/images/project-2.jpg" width="510" height="700" loading="lazy"
                    alt="Enhancing team collaboration through marketing" class="img-cover">
                </figure>

                <div class="card-content">

                  <p class="card-subtitle" style="color: white;">Digital Marketing</p>

                  <h3 class="h3">
                    <a href="https://repstack.co/building-cross-functional-teams-in-digital-marketing/" target="_blank" class="card-title">Digital strategy for team collaboration software</a>
                  </h3>

                  <p class="card-text" style="color: white;">Our targeted digital marketing campaign helped this team collaboration software company
                    boost product awareness and increase user sign-ups by 40% in just 6 months.</p>

                  <a href="https://repstack.co/building-cross-functional-teams-in-digital-marketing/" target="_blank" class="btn btn-primary">View Details</a>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 510; --height: 700;">
                  <img src="./assets/images/project-3.jpg" width="510" height="700" loading="lazy"
                    alt="Keyword strategy for a design platform" class="img-cover">
                </figure>

                <div class="card-content">

                  <p class="card-subtitle" style="color: white;">Keyword Targeting</p>

                  <h3 class="h3">
                    <a href="https://blog.hubspot.com/marketing/how-to-do-keyword-research-ht" target="_blank" class="card-title">Refining keyword strategy for a design platform</a>
                  </h3>

                  <p class="card-text" style="color: white;">We identified high-impact keywords for this design platform, leading to a 25% increase
                    in traffic and better visibility among its target audience.</p>

                  <a href="https://blog.hubspot.com/marketing/how-to-do-keyword-research-ht" target="_blank" class="btn btn-primary">View Details</a>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 510; --height: 700;">
                  <img src="./assets/images/project-4.jpg" width="510" height="700" loading="lazy"
                    alt="Streamlining task management through email marketing" class="img-cover">
                </figure>

                <div class="card-content">

                  <p class="card-subtitle" style="color: white;">Email Marketing</p>

                  <h3 class="h3">
                    <a href="https://www.emailtooltester.com/en/blog/email-automation-software/" target="_blank" class="card-title">Automated email campaigns for a task management app</a>
                  </h3>

                  <p class="card-text" style="color: white;">We designed automated email workflows that increased user engagement by 30% and helped
                    this app maintain a strong connection with its users through personalized content.</p>

                  <a href="https://www.emailtooltester.com/en/blog/email-automation-software/" target="_blank" class="btn btn-primary">View Details</a>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 510; --height: 700;">
                  <img src="./assets/images/project-5.jpg" width="510" height="700" loading="lazy"
                    alt="Improving marketing reporting for agile teams" class="img-cover">
                </figure>

                <div class="card-content">

                  <p class="card-subtitle" style="color: white;">Marketing & Reporting</p>

                  <h3 class="h3">
                    <a href="https://www.agilesherpas.com/blog/best-practices-backlog-refinement" target="_blank" class="card-title">Refining marketing reports for agile teams</a>
                  </h3>

                  <p class="card-text" style="color: white;">We developed custom reporting tools that provided real-time insights into marketing
                    performance, allowing agile teams to make data-driven decisions faster.</p>

                  <a href="https://www.agilesherpas.com/blog/best-practices-backlog-refinement" target="_blank" class="btn btn-primary">View Details</a>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 510; --height: 700;">
                  <img src="./assets/images/project-6.jpg" width="510" height="700" loading="lazy"
                    alt="Redesigning the New York Times mobile app" class="img-cover">
                </figure>

                <div class="card-content">

                  <p class="card-subtitle" style="color: white;">App Development</p>

                  <h3 class="h3">
                    <a href="https://www.casestudy.club/case-studies/redesigning-the-new-york-times-app" target="_blank" class="card-title">Redesigning the New York Times mobile app</a>
                  </h3>

                  <p class="card-text" style="color: white;">Our app development team worked closely with the New York Times to create a more user-friendly
                    mobile experience, resulting in improved app ratings and a 15% increase in active users.</p>

                  <a href="https://www.casestudy.club/case-studies/redesigning-the-new-york-times-app" target="_blank" class="btn btn-primary">View Details</a>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>


      <!-- 
        - #ABOUT
      -->

      <section class="section about" id="about" aria-label="about">
        <div class="container">

          <div class="about-banner img-holder" style="--width: 720; --height: 550;">
            <video src="https://media.istockphoto.com/id/1673647159/video/social-network-concept-with-blockchain-architecture-visualization-of-a-metaverse-big-data.mp4?s=mp4-640x640-is&k=20&c=uNLlw3GLRbpZKj2ZjZuEEoX_-ALGVlUlHH2pc6xQOJM=" autoplay loop muted></video>
          </div>

          <div class="about-content">

            <h2 class="h2 section-title">About GrowthGenius</h2>

            <p class="section-text">
              At GrowthGenius, we are passionate about helping businesses thrive in a digital world. From SEO and digital
              marketing to data-driven strategies, we empower companies to reach their full potential through cutting-edge
              marketing solutions.
            </p>

            <h3 class="h3">Who We Are</h3>

            <p class="section-text">
              GrowthGenius is a dynamic team of marketers, strategists, and data analysts with a singular goal: to drive
              growth for our clients. With over a decade of experience in digital marketing, we’ve helped businesses from
              startups to global brands scale their operations and connect with their audiences in more meaningful ways.
            </p>

            <h3 class="h3">Our Success</h3>

            <ul class="about-list">

              <li class="about-item">
                <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                <p class="section-text">
                  Successfully increased client revenue by an average of 40% through tailored SEO and digital marketing
                  strategies.
                </p>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                <p class="section-text">
                  Partnered with over 100 businesses, transforming their online presence and growing their customer base
                  through highly targeted campaigns.
                </p>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                <p class="section-text">
                  Award-winning strategies recognized for innovation and effectiveness in digital marketing and SEO
                  optimization.
                </p>
              </li>

            </ul>

            <h3 class="h3">Our Mission</h3>

            <p class="section-text">
              Our mission is simple: to deliver measurable, impactful results that help businesses grow. We believe in the
              power of data, creativity, and collaboration to drive successful marketing campaigns. We aim to build lasting
              relationships with our clients by aligning our strategies with their long-term goals and empowering them to
              succeed in an ever-changing marketplace.
            </p>

          </div>

        </div>
      </section>


      <!-- 
        - #CTA
      -->

      <section class="section cta" aria-label="cta" style="background-image: url('./assets/images/cta-bg.jpg')">
        <div class="container">

          <p class="cta-subtitle">So What is Next?</p>

          <h2 class="h2 section-title">Are You Ready? Let's get to Work!</h2>

          <a href="#service" class="btn btn-secondary">Get Started</a>

        </div>
      </section>





      <!-- 
        - #BLOG
      -->

      <section class="section blog" id="blog" aria-label="blog">
        <div class="container">

          <h2 class="h2 section-title">Latest Articles Updated Weekly</h2>

          <p class="section-text">
            Stay ahead of the curve with our weekly insights on digital marketing, SEO strategies, and the latest trends in user experience design.
          </p>

          <ul class="grid-list">

            <li>
              <div class="blog-card">

                <figure class="card-banner img-holder" style="--width: 860; --height: 646;">
                  <img src="./assets/images/blog-1.jpg" width="860" height="646" loading="lazy"
                    alt="How to Master SEO in 2024: Key Trends and Strategies" class="img-cover">
                </figure>

                <div class="card-content">

                  <time class="time" datetime="2024-10-16">October 16, 2024</time>

                  <h3 class="h3">
                    <a href="https://backlinko.com/seo-this-year" class="card-title">How to Master SEO in 2024: Key Trends and Strategies</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card grid">

                <figure class="card-banner img-holder" style="--width: 860; --height: 646;">
                  <img src="./assets/images/blog-2.jpg" width="860" height="646" loading="lazy"
                    alt="Maximizing Your Local SEO for Small Businesses" class="img-cover">
                </figure>

                <div class="card-content">

                  <time class="time" datetime="2024-10-10">October 10, 2024</time>

                  <h3 class="h3">
                    <a href="https://brilliant.digital/blog/13-local-seo-tips-for-small-business-owners" class="card-title">Maximizing Your Local SEO for Small Businesses</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card grid">

                <figure class="card-banner img-holder" style="--width: 860; --height: 646;">
                  <img src="./assets/images/blog-3.jpg" width="860" height="646" loading="lazy"
                    alt="Effective Digital Marketing Campaigns: Case Studies for 2024" class="img-cover">
                </figure>

                <div class="card-content">

                  <time class="time" datetime="2024-09-25">September 25, 2024</time>

                  <h3 class="h3">
                    <a href="https://blog.gwi.com/marketing/10-powerful-examples-of-marketing-that-works/" class="card-title">Effective Digital Marketing Campaigns: Case Studies for 2024</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card grid">

                <figure class="card-banner img-holder" style="--width: 860; --height: 646;">
                  <img src="./assets/images/blog-4.jpg" width="860" height="646" loading="lazy"
                    alt="How to Get Client Buy-in for Big Marketing Decisions" class="img-cover">
                </figure>

                <div class="card-content">

                  <time class="time" datetime="2024-09-18">September 18, 2024</time>

                  <h3 class="h3">
                    <a href="https://blog.hubspot.com/sales/get-stranger-interested-si" class="card-title">How to Get Client Buy-in for Big Marketing Decisions</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card grid">

                <figure class="card-banner img-holder" style="--width: 860; --height: 646;">
                  <img src="./assets/images/blog-5.jpg" width="860" height="646" loading="lazy"
                    alt="Top Blogs Every Marketer Should Follow in 2024" class="img-cover">
                </figure>

                <div class="card-content">

                  <time class="time" datetime="2024-09-10">September 10, 2024</time>

                  <h3 class="h3">
                    <a href="https://growthrocks.com/blog/top-digital-marketing-blogs/" class="card-title">Top Blogs Every Marketer Should Follow in 2024</a>
                  </h3>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>


      <!-- 
        - #CONTACT
      -->

      <!-- 
        - #CONTACT
      -->

      <section class="section contact" id="contact" aria-label="contact">
        <div class="container">

          <h2 class="h2 section-title">Let's Get in Touch</h2>

          <p class="section-text">
            Feel free to reach out to us for any inquiries or support. We're here to help you with your business needs.
          </p>

          <form action="https://api.web3forms.com/submit" method="POST" class="contact-form">

            <input type="hidden" name="access_key" value="791e0969-dc0a-4ccb-afd0-9a625d4d6ab1">

            <input type="hidden" name="from_name" value="GrowthGenius">

            <div class="input-wrapper">
              <input type="text" name="name" aria-label="name" placeholder="Your name*" required class="input-field" pattern="[A-Za-z\s]{1,50}" title="Please enter a valid name (letters only, max 50 characters)">

              <input type="email" name="email" aria-label="email" placeholder="Email address*" required class="input-field" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address">
            </div>

            <div class="input-wrapper">
              <input type="text" name="subject" aria-label="subject" placeholder="Subject for your email*" class="input-field" required pattern=".{1,100}" title="Subject should be between 1 and 100 characters">

              <input type="number" name="phone" aria-label="phone" placeholder="Phone number*" class="input-field" required pattern="\d{10}" title="Please enter a valid 10-digit phone number without spaces or symbols">
            </div>

            <textarea name="message" aria-label="message" placeholder="Your message...*" required class="input-field" pattern=".{10,500}" title="Message must be between 10 and 500 characters"></textarea>

            <div class="checkbox-wrapper">
              <input type="checkbox" name="terms_and_policy" id="terms" required class="checkbox">
              <label for="terms" class="label">
                Accept <a href="#" class="label-link">Terms of Services</a> and <a href="#" class="label-link">Privacy Policy</a>
              </label>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>

          </form>



          <ul class="contact-list">

            <li class="contact-item">
              <div class="contact-card">

                <div class="card-icon">
                  <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
                </div>

                <div class="card-content">

                  <h3 class="h3 card-title">Mail Here</h3>

                  <a href="mailto:harsh.rce810@gmail.com" class="card-link">harsh.rce810@gmail.com</a>

                </div>

              </div>
            </li>

            <li class="contact-item">
              <div class="contact-card">

                <div class="card-icon">
                  <ion-icon name="map-outline" aria-hidden="true"></ion-icon>
                </div>

                <div class="card-content">

                  <h3 class="h3 card-title">Visit Here</h3>

                  <address class="card-address">
                    10, Sector 21, Gandhinagar,<br>
                    Gujarat, India 382021
                  </address>

                </div>

              </div>
            </li>

            <li class="contact-item">
              <div class="contact-card">

                <div class="card-icon">
                  <ion-icon name="headset-outline" aria-hidden="true"></ion-icon>
                </div>

                <div class="card-content">

                  <h3 class="h3 card-title">Call Here</h3>

                  <a href="tel:+919493743432" class="card-link">+91 9493743432</a>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>
    </article>
  </main>

  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="container">

      <p class="copyright">
        &copy; 2024 All Rights Reserved by <a href="#" class="copyright-link">Harsh810004</a>
      </p>

    </div>
  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" aria-label="back to top" data-back-top-btn class="back-top-btn">
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
    // JavaScript to handle Get Started button click
    document.getElementById('getStartedBtn').addEventListener('click', function(e) {
      <?php if (!isset($_SESSION['first_name'])) { ?>
        e.preventDefault(); // Prevent the default anchor behavior
        alert("You need to log in or register first!"); // Show alert
        // Redirect to login/register page
        window.location.href = 'user.php'; // Change to your login/register page
      <?php } else { ?>
        window.location.href = '#service'; // Navigate to Services section
      <?php } ?>
    });
  </script>

</body>

</html>