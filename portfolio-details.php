<?php
  include("init.php");
  $admin = new Admin();
  $post = new PostManager();

  $address = $admin->getCompanyAddresses();
  $contacts = $admin->getCompanyContacts();
  $phone = array_filter($contacts, function($record){
    return $record->type === 'phone';
  });
  $email = array_filter($contacts, function($record){
    return $record->type === 'email';
  });
  $social_lins = $admin->getSocialMediaLinks();

  if(isset($_GET["item"])){
    $db_post = $post->getPost($_GET["item"]);
    // Convert it to a DateTime object
    $date = new DateTime($db_post->CreatedAt);
    // Format it in a more official format
    $formattedDate = $date->format('l, d F Y h:i A');
    $imgs = $post->getPostImages($db_post->Id);
  }else{
    header("Location: index.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Portfolio Details - MHA</title>
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

<body class="portfolio-details-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">MHA</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="feedback.php">Feedback</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
</header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1 style="font-variant: small-caps; letter-spacing: 8px;">METAL HUB AUSTRALIA</h1>
        <p style="font-variant: small-caps; letter-spacing: 10px;">Turning old into gold</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Portfolio Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper">

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

              <div class="swiper-wrapper align-items-center">
                <?php
                  foreach ($imgs as $postImg) {?>
                  
                  <div class="swiper-slide">
                    <img src="uploads/<?php echo $postImg->ImagePath; ?>" alt="">
                  </div>

                <?php }?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
              <h3>Item information</h3>
              <ul>
                <li><strong>Category</strong>: <?php echo $db_post->catagory;?></li>
                <li><strong>Created date</strong>: <?php echo $formattedDate;?></li>
              </ul>
            </div>
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
              <h2><?php echo $db_post->Title;?></h2>
              <p>
                <?php echo $db_post->Description;?>
              </p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>