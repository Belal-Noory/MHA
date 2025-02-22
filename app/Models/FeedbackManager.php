<?php
class FeedbackManager {
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    // Add customer feedback
    public function addFeedback($params)
    {
        $query = "INSERT INTO CustomerFeedback (Name, Email, Rating, Feedback) VALUES (?, ?, ?, ?)";
        return $this->conn->Query($query, $params, true);
    }

    // Get all feedback
    public function getAllFeedback()
    {
        $query = "SELECT * FROM CustomerFeedback ORDER BY CreatedAt DESC";
        return $this->conn->Query($query);
    }

    // Get average rating
    public function getAverageRating()
    {
        $query = "SELECT AVG(Rating) as AverageRating FROM CustomerFeedback";
        $result = $this->conn->Query($query, [], false);
        return $result ? round($result['AverageRating'], 1) : 0;
    }
}
?>
