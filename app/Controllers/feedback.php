<?php
require "../../init.php";
$feedbackObj = new FeedbackManager();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addfeedback"])) {
        $name = trim($_POST["name"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $rating = isset($_POST["rating"]) ? (int)$_POST["rating"] : 0;
        $feedback = trim($_POST["feedback"] ?? '');

        if ($rating < 1 || $rating > 5 || empty($name)) {
            echo json_encode(["status" => "error", "message" => "Invalid data provided"]);
            exit;
        }

        try {
            $params = [$name, $email, $rating, $feedback];
            $result = $feedbackObj->addFeedback($params);

            if ($result > 0) {
                echo json_encode(["status" => "success", "message" => "Feedback submitted successfully"]);
                exit;
            } else {
                echo json_encode(["status" => "error", "message" => "Database error"]);
                exit;
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            exit;
        }
    }
}else{
    // Always return a response in case nothing was matched
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

?>

