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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Feeback - MHA</title>
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

  <style>
        body {
            background-color: #f8f9fa;
        }
        .feedback-card {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .star-rating {
            font-size: 24px;
            cursor: pointer;
            color: #ddd;
        }
        .star-rating.active {
            color: #ffcc00;
        }
    </style>
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
            <li class="current">Feedback</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="feedback-card">
            <h4 class="text-center mb-4">Rate Our Service</h4>
            <form id="feedbackForm">
                <div class="mb-3">
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Your Name...">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address...">
                </div>
                <div class="mb-3">
                    <div id="starRating">
                        <i class="bi bi-star star-rating" data-value="1"></i>
                        <i class="bi bi-star star-rating" data-value="2"></i>
                        <i class="bi bi-star star-rating" data-value="3"></i>
                        <i class="bi bi-star star-rating" data-value="4"></i>
                        <i class="bi bi-star star-rating" data-value="5"></i>
                    </div>
                    <input type="hidden" id="rating" name="rating" value="0">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="feedback" name="feedback" rows="4" placeholder="Your feedback..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-2">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <i class="bi bi-check"></i>
                    Submit Feedback
                </button>
            </form>
        </div>
    </div>

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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star-rating");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", function () {
                const rating = this.getAttribute("data-value");
                ratingInput.value = rating;

                stars.forEach(s => s.classList.remove("active", "bi-star-fill"));
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add("active", "bi-star-fill");
                }
            });
        });

        $("#feedbackForm").on("submit", function (e) {
            e.preventDefault();
            ths = $(this);

            $(ths).children("button").children("span").removeClass("d-none");
            $(ths).children("button").children("i").addClass("d-none");
            $(ths).children("button").attr("disabled", 'TRUE');

            const name = $("#name").val().trim();
            const email = $("#email").val().trim();
            const rating = $("#rating").val();
            const feedback = $("#feedback").val().trim();
            if (rating == "0") {
                Swal.fire("Error", "Please select a rating!", "error");
                return;
            }

            $.post("app/Controllers/feedback.php",{name,email,rating,feedback,addfeedback:true},function(response) {
                var res = JSON.parse(response);
                if (res.status === "success") {
                    Swal.fire("Thank You!", "Your feedback has been submitted.", "success");
                    $("#feedbackForm")[0].reset(); // Reset form
                    $(".bi-star-fill").removeClass("active bi-star-fill");
                    $("#ratingInput").val("0"); // Reset rating input

                    $(ths).children("button").children("span").addClass("d-none");
                    $(ths).children("button").children("i").removeClass("d-none");
                    $(ths).children("button").removeAttr("disabled");
                } else {
                    Swal.fire("Error", res.message, "error");
                    $(ths).children("button").children("span").addClass("d-none");
                    $(ths).children("button").children("i").removeClass("d-none");
                    $(ths).children("button").removeAttr("disabled");
                }  
                        
            });

        });
    });
</script>

</body>

</html>