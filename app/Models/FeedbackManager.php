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

    // Get feedback by ID
    public function getFeedbackById($ID)
    {
        $query = "SELECT * FROM CustomerFeedback WHERE FeedbackID = ? ORDER BY CreatedAt DESC";
        return $this->conn->Query($query,[$ID]);
    }

    // Delete Feedback by ID
    public function Delete($ID)
    {
        $query = "DELETE FROM CustomerFeedback WHERE FeedbackID = ?";
        return $this->conn->Query($query,[$ID]);
    }

    // Get all feedback
    public function getNewFeedback()
    {
        $query = "SELECT * FROM CustomerFeedback WHERE Status = ? ORDER BY CreatedAt DESC";
        return $this->conn->Query($query,['New']);
    }

    // Get all feedback
    public function updateFeedbackStatus($status,$ID)
    {
        $query = "UPDATE CustomerFeedback SET Status = ? WHERE FeedbackID = ?";
        return $this->conn->Query($query,[$status,$ID]);
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
