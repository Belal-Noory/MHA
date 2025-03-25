<?php
  include("init.php");
  $admin = new Admin();
  $post = new PostManager();
  $feedbackManager = new FeedbackManager();

  $details = $admin->getCompanyDetails();
  $address = $admin->getCompanyAddresses();
  $contacts = $admin->getCompanyContacts();
  $phone = array_filter($contacts, function($record){
    return $record->type === 'phone';
  });
  $email = array_filter($contacts, function($record){
    return $record->type === 'email';
  });
  $social_lins = $admin->getSocialMediaLinks();
  $posts = $post->getPosts();
  $postCatagory = $post->getPostCatagory();

  $feedbacks = $feedbackManager->getAllFeedback();
  $feedbackData = $feedbacks->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>META HUB AUSTRALIA</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="scrolled header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">MHA</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="feedback.php">Feedback</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
     <div class="hero">
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
          <?php
            $imageFolder = "assets/img/slidshow/"; // Ensure the trailing slash
            $images = glob($imageFolder . "*.{jpg,png,jpeg,gif}", GLOB_BRACE);
            $active = "active";

            foreach ($images as $image) {
                echo '<div class="carousel-item ' . $active . '">
                        <img src="' . $image . '" class="d-block w-100" alt="Slideshow Image">
                      </div>';
                $active = ""; // Only the first image should have the 'active' class
            }
            ?>

            
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">
          <div class="col-xs-12 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/imgs/Logo/Black_Logo.png" class="img-fluid rounded-4 mb-4" alt="">
          </div>
          <div class="col-xs-12 col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <h3>METAL HUB AUSTRALIA</h3>
            <p><?php echo $details[0]->background; ?></p>
          </div>
        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="3000" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo count($posts);?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Items</p>
              </div>
            </div>
          </div><!-- End Stats Item -->
        </div>
      </div>
    </section><!-- /Stats Section -->

    <?php if($feedbacks->rowCount() > 0){?>
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

      <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">
            <?php
              foreach ($feedbackData as $fdata) {
                $rate = $fdata->Rating;?>
              
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <h3><?php echo $fdata->Name; ?></h3>
                    <?php if(!empty($fdata->Email)){ echo "<h4>$fdata->Email</h4>";} ?>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span><?php echo $fdata->Feedback; ?></span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->
              
              <?php }?>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->
    <?php } ?>
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>CHECK OUR PORTFOLIO</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <?php
              if(count($postCatagory) > 0){
                foreach ($postCatagory as $cat) {
                  echo "<li data-filter='.$cat->catagory'>$cat->catagory</li>";
                }
              }
            ?>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

          <?php
            if(count($posts) > 0){
              foreach ($posts as $pst) {
                $img = $post->getPostImage($pst->Id);
                ?>
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?php echo $pst->catagory ?>">
                <div class="portfolio-content h-100">
                  <img src="uploads/<?php echo $img->ImagePath;?>" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4><?php echo $pst->Title ?></h4>
                    <p><?php echo substr($pst->Description, 0, 100) . '...'; ?></p>
                    <a href="uploads/<?php echo $img->ImagePath;?>" title="<?php echo $pst->Title ?>" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="portfolio-details.php?item=<?php echo $pst->Id ?>" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div>
            <?php }}else{?>
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                <div class="portfolio-content h-100">
                  <img src="assets/img/portfolio/app-1.jpg" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4>Test</h4>
                    <p>This is a test post, please add posts in admin panel</p>
                    <a href="assets/img/portfolio/app-1.jpg" title="Test" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div>
          <?php }?>
          </div><!-- End Portfolio Container -->
        </div>
      </div>
    </section><!-- /Portfolio Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Message us if you have something to sell.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p><?php echo $address[0]->Street.', '.$address[0]->City.', '.$address[0]->State.', '.$address[0]->PostalCode.', '.$address[0]->Country; ?></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p><?php echo $phone[0]->contact; ?></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p><?php echo $email[1]->contact; ?></p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-6">
            <form action="app/Controllers/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                </div>
                <input type="hidden" name="sendMessage">
                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">MHA</span>
          </a>
          <div class="footer-contact pt-3">
            
            <p><?php echo $address[0]->Street.', '.$address[0]->City; ?></p>
            <p><?php echo $address[0]->State.', '.$address[0]->PostalCode; ?></p>
            <p><?php echo $address[0]->Country; ?></p>
            <p class="mt-3"><strong>Phone:</strong> <span><?php echo $phone[0]->contact; ?></span></p>
            <p><strong>Email:</strong> <span><?php echo $email[1]->contact; ?></span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <?php if(count($social_lins) > 0){
              foreach ($social_lins as $link) {
                $platform = strtolower($link->Platform);
                echo "<a href='$link->ProfileLink' target='_blank'><i class='bi bi-$platform'></i></a>";
              }
            } ?>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">MHA</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>