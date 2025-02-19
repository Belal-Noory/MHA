<?php
    $title = "Dashboard";
    require("master/header.php");

    $admin = new Admin();
    $address = $admin->getCompanyAddresses();
    $background = $admin->getCompanyDetails();
    
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-lg-7 m-1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Company Background</h5>
                    <form class="form" method="POST" action="../app/Controllers/admin.php">
                        <div class="form-group">
                            <label for="background">Company Background</label>
                            <textarea name="background" id="background" cols="30" rows="10" class="form-control" placeholder="Background..."><?php if(count($background) > 0){echo $background[0]->background;} ?></textarea>
                        </div>
                        <input type="hidden" name="updateBackground" id="updateBackground" value="true">
                        <input type="hidden" name="Id" id="Id" value="<?php if(count($background) > 0){echo $background[0]->Id;}else{echo 0;} ?>">
                        <button type="submit" class="btn btn-primary btn-user">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 m-1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Company Address</h5>
                    <form class="form" method="POST" action="../app/Controllers/admin.php">
                        <div class="form-group">
                            <label for="Street">Street</label>
                            <input type="text" name="Street" id="Street" placeholder="Street..." class="form-control" value="<?php if(count($address) > 0){echo $address[0]->Street;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="City">City</label>
                            <input type="text" name="City" id="City" placeholder="City..." class="form-control" value="<?php if(count($address) > 0){echo $address[0]->City;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="State">State</label>
                            <input type="text" name="State" id="State" placeholder="State..." class="form-control" value="<?php if(count($address) > 0){echo $address[0]->State;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="PostalCode">PostalCode</label>
                            <input type="text" name="PostalCode" id="PostalCode" placeholder="PostalCode..." class="form-control" value="<?php if(count($address) > 0){echo $address[0]->PostalCode;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="Country">Country</label>
                            <input type="text" name="Country" id="Country" placeholder="Country..." class="form-control" value="<?php if(count($address) > 0){echo $address[0]->Country;} ?>">
                        </div>
                        <input type="hidden" name="addaddress" id="addaddress" value="true">
                        <input type="hidden" name="Id" id="Id" value="<?php if(count($address) > 0){echo $address[0]->Id;}else{echo 0;} ?>">
                        <button type="submit" class="btn btn-primary btn-user">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <i class="fas fa-save"></i>
                            Save Changes
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

            