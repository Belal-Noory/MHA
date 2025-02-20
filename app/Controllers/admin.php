<?php
session_start();
require "../../init.php";

$admin = new Admin();
$postManager = new PostManager();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Add company details
    if (isset($_POST["updateBackground"])) {
        $Id = helper::test_input($_POST["Id"]);
        $background = helper::test_input($_POST["background"]);
        if($Id > 0){
            $admin->UpdateCompanyDetails([$background,$Id]);
        }else{
            $admin->addCompanyDetails([$background]);
        }
        header("Location: ../../Admin/dashboard.php");
    }

    // Add company contact
    if (isset($_POST["addcontact"])) {
        $contact = helper::test_input($_POST["contact"]);
        $type = helper::test_input($_POST["type"]);
        // Call add function
        $res = $admin->addCompanyContact([$contact, $type]);
        header("Location: ../../Admin/contacts.php");
    }

    // Delete company contact
    if (isset($_POST["deleteContact"])) {
        $Id = helper::test_input($_POST["Id"]);

        // Call add function
        $res = $admin->DeleteCompanyContact($Id);
        echo $res;
    }

    // Add company address
    if (isset($_POST["addaddress"])) {
        $Id = helper::test_input($_POST["Id"]);
        $street = helper::test_input($_POST["Street"]);
        $city = helper::test_input($_POST["City"]);
        $state = helper::test_input($_POST["State"]);
        $postalCode = helper::test_input($_POST["PostalCode"]);
        $country = helper::test_input($_POST["Country"]);
        if($Id > 0)
        {
            $admin->UpdateCompanyAddress([$street, $city, $state, $postalCode, $country, $Id]);
        }else{
            // Call add function
            $admin->addCompanyAddress([$street, $city, $state, $postalCode, $country]);
        }
        header("Location: ../../Admin/dashboard.php");
    }

    // Add social media link
    if (isset($_POST["addSocial"])) {
        $platform = helper::test_input($_POST["platform"]);
        $profileLink = helper::test_input($_POST["profileLink"]);
        // Call add function
        $res = $admin->addSocialMediaLink([$platform, $profileLink]);
        header("Location: ../../Admin/social.php");
    }

    // Delete social media link
    if (isset($_POST["deleteSocial"])) {
        $Id = helper::test_input($_POST["Id"]);
        // Call add function
        $res = $admin->deleteSocialMediaLink($Id);
        echo $res;
    }


    // Add Post
    if (isset($_POST["addPost"])) {
        $title = helper::test_input($_POST["title"]);
        $description = helper::test_input($_POST["description"]);
        $catagory = helper::test_input($_POST["catagory"]);
        $images = $_FILES['images'];

        $res = $postManager->addPost([$title, $description, $catagory], $images);
        if ($res) {
            header("Location: ../../Admin/post.php?success=PostAdded");
        } else {
            header("Location: ../../Admin/post.php?error=FailedToAddPost");
        }
    }

    // Delete Post
    if (isset($_POST["deletePost"])) {
        $Id = helper::test_input($_POST["Id"]);
        $res = $postManager->deletePost($Id);
        echo $res;
    }

    // Update Login password
    if (isset($_POST["updatePass"])) {
        $newPassword = helper::test_input($_POST["newPassword"]);
        $oldPassword = helper::test_input($_POST["oldPassword"]);

        $user = $admin->getUserByEmail($_SESSION["adminLogged"]);
        if($user->pass == $oldPassword)
        {
            // Call add function
            $res = $admin->updateUser([$newPassword, $_SESSION["adminLogged"]]);
            if($res > 0)
            {
                echo json_encode(array("success"=>"true"));
            }else{
                echo json_encode(array("success"=>"false"));
            }
        }else{
            echo json_encode(array("success"=>"Old password is incorrect!"));
        }
        
    }

    // Get Login
    if (isset($_POST["getlogin"])) {
        $email = helper::test_input($_POST["email"]);
        $password = helper::test_input($_POST["password"]);
        // Call add function
        $res = $admin->getUser($email, $password);
        if(count($res) > 0)
        {
            $user = $res[0];
            $_SESSION["adminLogged"] = $user->email;
            echo json_encode(array("success"=>"true"));
        }else{
            echo json_encode(array("success"=>"false"));
        }
    }

    // Add Login
    if (isset($_POST["adduser"])) {
        $email = helper::test_input($_POST["email"]);
        $password = helper::test_input($_POST["password"]);
        // Call add function
        $res = $admin->addUser([$email, $password]);
        header("Location: ../../Admin/users.php");
    }

    // Delete User
    if(isset($_POST["deleteUser"])){
        $Id = helper::test_input($_POST["Id"]);
        $res = $admin->DeleteUser($Id);
        echo $res;
    }

    if(isset($_POST["logout"]))
    {
        session_unset(); // Unset session variables
        session_destroy(); // Destroy session
        echo json_encode(array("success"=>"true"));
        exit();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    
}
?>