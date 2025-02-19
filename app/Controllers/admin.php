<?php
session_start();
require "../../init.php";

$admin = new Admin();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Add company details
    if (isset($_POST["adddetails"])) {
        $background = helper::test_input($_POST["background"]);
        // Call add function
        $res = $admin->addCompanyDetails([$background]);
        echo $res;
    }

    // Add company contact
    if (isset($_POST["addcontact"])) {
        $contact = helper::test_input($_POST["contact"]);
        $type = helper::test_input($_POST["type"]);
        // Call add function
        $res = $admin->addCompanyContact([$contact, $type]);
        echo $res;
    }

    // Add company address
    if (isset($_POST["addaddress"])) {
        $street = helper::test_input($_POST["street"]);
        $city = helper::test_input($_POST["city"]);
        $state = helper::test_input($_POST["state"]);
        $postalCode = helper::test_input($_POST["postalCode"]);
        $country = helper::test_input($_POST["country"]);
        // Call add function
        $res = $admin->addCompanyAddress([$street, $city, $state, $postalCode, $country]);
        echo $res;
    }

    // Add social media link
    if (isset($_POST["addsocial"])) {
        $platform = helper::test_input($_POST["platform"]);
        $profileLink = helper::test_input($_POST["profileLink"]);
        // Call add function
        $res = $admin->addSocialMediaLink([$platform, $profileLink]);
        echo json_encode($res);
    }


    // Get Login
    if (isset($_POST["getlogin"])) {
        $email = helper::test_input($_POST["email"]);
        $password = helper::test_input($_POST["password"]);
        // Call add function
        $res = $admin->getUser($email, $password);
        echo $res;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    
}
?>