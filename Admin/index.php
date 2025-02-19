<?php
    require("../init.php");
    if(isset($_SESSION["adminLogged"])){
        header("dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MHA - Login</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image bg-dark">
                                <img src="../assets/imgs/Logo/Transparent_Logo.png" alt="Logo" class="img-fluid mt-2">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="loginForm">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="pass" placeholder="Password">
                                        </div>
                                        <button type="button" id="btnlogin" class="btn btn-primary btn-user btn-block">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            <i class="fas fa-lock"></i>
                                             Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            

            $("#btnlogin").on("click",function(e){
                e.preventDefault();
                ths = $(this);

                // Get input values
                var email = $("#email").val().trim();
                var password = $("#pass").val().trim();

                // Validate inputs
                if (email === "" || password === "") {
                    Swal.fire({
                        title: "Error",
                        text: "Please fill in both fields.",
                        icon: "error"
                    });
                    return;
                }

                // Disable button and show spinner
                $(ths).children(".fas").addClass("d-none");
                $(ths).children(".spinner-border").removeClass("d-none");
                $(ths).attr("disabled", true);

                // AJAX request for login
                $.ajax({
                    url: "../app/Controllers/admin.php", // Change this to your actual login endpoint
                    type: "POST",
                    data: { email: email, password: password, getlogin: 'TRUE' },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status === "success") {
                            //window.location.href = "dashboard.php"; // Redirect on success
                        } else {
                            Swal.fire({
                                title: "Server Error",
                                text: response.message,
                                icon: "error"
                            });
                            $(ths).children(".spinner-border").addClass("d-none");
                            $(ths).children(".fas").removeClass("d-none");
                            $(ths).attr("disabled", false);
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: "Error",
                            text: "Something went wrong. Please try again.",
                            icon: "error"
                        });
                        $(ths).children(".spinner-border").addClass("d-none");
                        $(ths).children(".fas").removeClass("d-none");
                        $(ths).attr("disabled", false);
                    }
                });

            });



        });
    </script>
</body>

</html>