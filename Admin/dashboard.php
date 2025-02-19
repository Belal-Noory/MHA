<?php
    session_start();
    if(!isset($_SESSION["adminLogged"]))
    {
        header("Location: index.php?login=false");
        exit();
    }
    $title = "Dashboard";
    require("master/header.php")
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

</div>
<!-- /.container-fluid -->
                
<?php
require("master/footer.php")
?>
            