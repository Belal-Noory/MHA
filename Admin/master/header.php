<?php
session_start();
if(!isset($_SESSION["adminLogged"]))
{
    header("Location: index.php?login=false");
    exit();
}
include("../init.php");

$nav_items = [
    "Dashboard" => ["icon" => "fas fa-fw fa-tachometer-alt", "link" => "dashboard.php"],
    "Users" => ["icon" => "fas fa-fw fa-users", "link" => "users.php"],
    "Contacts" => ["icon" => "fas fa-fw fa-phone", "link" => "contacts.php"],
    "Social Media" => ["icon" => "fas fa-fw fa-inbox", "link" => "social.php"],
    "Posts" => ["icon" => "fas fa-fw fa-image", "link" => "post.php"],
    "Feedbacks" => ["icon" => "fas fa-fw fa-comments", "link" => "feedbacks.php"],
    "Emails" => ["icon" => "fas fa-fw fa-envelope", "link" => "emails.php"],
    "Slidshow" => ["icon" => "fas fa-fw fa-images", "link" => "slidshow.php"]
];

$feedbackManager = new FeedbackManager();
$newFeedbaks = $feedbackManager->getNewFeedback();

$contactManager = new Contact();
$newContacts = $contactManager->getMessageByStatus("New");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MHA - <?php echo $title;?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.2.2/af-2.7.0/b-3.2.2/b-colvis-3.2.2/b-html5-3.2.2/b-print-3.2.2/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.4/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.2/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css" rel="stylesheet" integrity="sha384-tcpLS082NsWkf2sk3Y7oI4z+FwOy/tzttutCBnU15RoNYFbkrZo7BCt9U/ENMiUM" crossorigin="anonymous">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="../assets/imgs/Logo/Transparent_Logo_mini.svg" alt="logo" width="80">
                </div>
                <div class="sidebar-brand-text mx-3">MHA Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php foreach ($nav_items as $name => $item): ?>
                <li class="nav-item <?= ($title == $name) ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= $item['link'] ?>">
                        <i class="<?= $item['icon'] ?>"></i>
                        <span><?= $name ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Contact US -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo $newContacts->rowCount(); ?>+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Emails Center (Contact US)
                                </h6>
                                <?php 
                                    if($newContacts->rowCount() > 0){
                                        $newContactData = $newContacts->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($newContactData as $CData) {
                                            // Convert it to a DateTime object
                                            $date = new DateTime($CData->CreatedAt);
                                            // Format it in a more official format
                                            $fDate = $date->format('l, d F Y h:i A');?>
                                                <a class="dropdown-item d-flex align-items-center" href="emails.php?email=<?php echo $CData->MessageID; ?>">
                                                    <div class="mr-3">
                                                        <div class="icon-circle bg-primary">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="small text-gray-600"><?php echo $fDate; ?></div>
                                                        <div class="small text-gray-700"><?php echo $CData->Name.', '.$CData->Email; ?></div>
                                                        <div class="small text-gray-800"><?php echo $CData->Subject; ?></div>
                                                        <span class="font-weight-bold"><?php echo substr($CData->Message, 0, 100) . '...'; ?></span>
                                                    </div>
                                                </a>
                                        <?php   }
                                    }
                                ?>
                                <a class="dropdown-item text-center small text-gray-600" href="emails.php">Show All Emails</a>
                            </div>
                        </li>

                        <!-- Nav Item - Feedbacks -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-comments fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo $newFeedbaks->rowCount(); ?>+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Feedbacks Center
                                </h6>
                                <?php
                                    if($newFeedbaks->rowCount() > 0){
                                        $newFeedbaksData = $newFeedbaks->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($newFeedbaksData as $Data) {
                                            // Convert it to a DateTime object
                                            $date = new DateTime($Data->CreatedAt);
                                            // Format it in a more official format
                                            $formattedDate = $date->format('l, d F Y h:i A');?>
                                            <a class="dropdown-item d-flex align-items-center" href="feedbacks.php?feedback=<?php echo $Data->FeedbackID; ?>">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary">
                                                        <i class="fas fa-comment text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-gray-600"><?php echo $formattedDate; ?></div>
                                                    <span class="font-weight-bold"><?php echo substr($Data->Feedback, 0, 100) . '...'; ?></span>
                                                </div>
                                            </a>
                                    <?php }
                                    }
                                ?>
                                <a class="dropdown-item text-center small text-gray-600" href="feedbacks.php">Show All Feedbacks</a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="settings.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="btnlogout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->