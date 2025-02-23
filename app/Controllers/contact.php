<?php
require "../../init.php";
$contact = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Add company email
    if (isset($_POST["sendMessage"])) {
        $name = helper::test_input($_POST["name"]);
        $email = helper::test_input($_POST["email"]);
        $subject = helper::test_input($_POST["subject"]);
        $message = helper::test_input($_POST["message"]);

        $res = $contact->addContactMessage([$name,$email,$subject,$message]);
        if($res > 0){
            // Simulate a successful form submission
            http_response_code(200); // Set success response code
            echo json_encode(["message" => "OK"]);
            exit;
        }else{
            http_response_code(400); // Bad request if "sendMessage" is missing
            echo json_encode(["error" => "An error occured while sending message, please try again!"]);
        }
    }


    // delete an email
    if(isset($_POST["deleteemail"])){
        $ID = helper::test_input($_POST["ID"]);
        $res = $contact->Delete($ID);
        if($res->rowCount() > 0){
            echo json_encode(["status" => "success", "message" => "Email deleted successfully"]);
            exit;
        }else {
            echo json_encode(["status" => "error", "message" => "Database error"]);
            exit;
        }
    }


}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    
}
?>