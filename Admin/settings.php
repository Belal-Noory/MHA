<?php
    $title = "Dashboard";
    require("master/header.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Settings</h1>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Change Password</h5>
                    <form class="form">
                        <div class="mb-3">
                            <label for="oldpassword" class="form-label">Old Password</label>
                            <input type="password" name="oldpassword" id="oldpassword" placeholder="Old Password...." class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="newpassword" class="form-label">New Password</label>
                            <input type="password" name="newpassword" id="newpassword" placeholder="New Password...." class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary btn-user" id="btnUpdatePass">
                            <i class="fas fa-lock"></i>
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
                
<?php
require("master/footer.php")
?>

<script>
        $(document).ready(function(){
            $("#btnUpdatePass").on("click",function(e){
                e.preventDefault();
                ths = $(this);

                // Get input values
                var newPassword = $("#newpassword").val().trim();
                var oldPassword = $("#oldpassword").val().trim();

                // Validate inputs
                if (newPassword === "" || oldPassword === "") {
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

                if(newPassword != newPassword){
                    // AJAX request for login
                    $.ajax({
                        url: "../app/Controllers/admin.php", // Change this to your actual login endpoint
                        type: "POST",
                        data: { newPassword: newPassword, oldPassword: oldPassword, updatePass: 'TRUE' },
                        dataType: "json",
                        cache: false,
                        success: function (response) {
                            if (response.success == "true") {
                                Swal.fire({
                                    title: "Success",
                                    text: "Password changed successfully",
                                    icon: "success"
                                });
                                $(ths).children(".spinner-border").addClass("d-none");
                                $(ths).children(".fas").removeClass("d-none");
                                $(ths).attr("disabled", false);
    
                                $("#newpassword").val("");
                                $("#oldpassword").val("");
                            } else {
                                Swal.fire({
                                    title: "Server Error",
                                    text: response.success,
                                    icon: "error"
                                });
                                $(ths).children(".spinner-border").addClass("d-none");
                                $(ths).children(".fas").removeClass("d-none");
                                $(ths).attr("disabled", false);
                            }
                        },
                        error: function (e) {
                            Swal.fire({
                                title: "Error",
                                text: e.responseText,
                                icon: "error"
                            });
                            $(ths).children(".spinner-border").addClass("d-none");
                            $(ths).children(".fas").removeClass("d-none");
                            $(ths).attr("disabled", false);
                        }
                    });
                }else{
                    Swal.fire({
                                title: "Error",
                                text: "New password should be not same as old password",
                                icon: "error"
                            });
                }

            });

        });
    </script>

            